<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Peminjaman;
use App\Providers\UserProfileProvider;
use App\Http\Controllers\BaseController;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminController extends BaseController
{

    // === BOOK ===

    function showAddBookPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('book.add', ['success' => false, 'categories' => Category::all()]);
        }
        return redirect()->back();
    }

    function addBook(Request $request, UserProfileProvider $UserProfileProvider)
    {
        if (!$UserProfileProvider->isAdmin()) return redirect()->back();

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'publisher' => ['required', 'string', 'max:255'],
            'cover' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'publishing_year' => ['required', 'integer', 'not_in:0'],
            'isbn' => ['required', 'string', 'max:13'],
            'language' => ['nullable', 'string', 'max:30'],
            'categories' => ['']
        ]);

        $imageName = time() . '.' . $request->cover->extension();
        $image = $request->file('cover');
        $image->storeAs('public/covers', $imageName);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'publisher' => $request->publisher,
            'cover' => $imageName,
            'publishing_year' => $request->publishing_year,
            'isbn' => $request->isbn,
            'language' => $request->language
        ]);

        // add categories for book
        $book->categories()->sync($request->categories);

        return view('book.add', ['success' => true, 'categories' => Category::all()]);
    }

    function showListBookPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            $paginator = Book::all();

            // Get the S3 URL from the environment
            $s3Url = env('AWS_STORAGE_PATH');

            // Transform the cover URLs
            foreach ($paginator as $book) {
                $book->cover = $s3Url . '/public/covers/' . $book->cover;
            }

            return view('book.list', [
                'paginator' => $paginator
            ]);
        } else return redirect()->back();
    }

    function deleteBook(Request $request, UserProfileProvider $userProfileProvider)
    {
        if ($userProfileProvider->isAdmin()) {
            $book = Book::findOrFail($request->id);
            Storage::delete('public/covers/' . $book->cover);
            $book->delete();

            return redirect()->route('book.list')->with(['success' => 'Data Berhasil Dihapus!']);
        } else return redirect()->back();
    }

    function showEditBookPage(string $id, UserProfileProvider $userProfileProvider)
    {
        if (!$userProfileProvider->isAdmin()) return redirect()->back();

        $decodedId = base64_decode(strval($id));
        $book = Book::where('id', $decodedId)->first();

        return view('book/edit', [
            'book' => $book,
            'categories' => Category::all(),
            'selectedCategories' => $book->categories()->get()->pluck('id')->toArray()
        ]);
    }

    function editBook(string $id, Request $request, UserProfileProvider $userProfileProvider)
    {
        if (!$userProfileProvider->isAdmin()) return redirect()->back();

        // get book by id
        $book = Book::whereId($id)->first();

        // check whether need to update image
        $imageName = $book->cover;
        if (($request->cover != null && $request->cover != '') && $book->cover != $request->cover) {
            $imageName = time() . '.' . $request->cover->extension();
            $image = $request->file('cover');
            $image->storeAs('public/covers', $imageName);

            // delete cover after cover updated
            Storage::delete('public/covers/' . $book->cover);
        }

        // do update
        $book->update([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'publisher' => $request->publisher,
            'cover' => $imageName,
            'publishing_year' => $request->publishing_year,
            'isbn' => $request->isbn,
            'stock' => $request->stock,
            'language' => $request->language
        ]);
        $book->categories()->sync($request->categories);

        return redirect()->route('book.edit', ['id' => base64_encode(strval($id))])->with(['success' => true]);
    }

    // === PEMINJAMAN ===

    function showPeminjamanPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            $data = DB::table('peminjaman')
                ->select(
                    'peminjaman.id',
                    'peminjaman.created_at',
                    'peminjaman.status',
                    'peminjaman.return_at',
                    'peminjaman.updated_at',
                    'user.id as userId',
                    'user.name',
                    'book.cover',
                    'book.title',
                    'book.isbn',
                    'book.author'
                )
                ->leftJoin('user', 'user.id', '=', 'peminjaman.user_id')
                ->leftJoin('book', 'book.id', '=', 'peminjaman.book_id')
                ->get();


                $books = $data->map(function($book) {
                    $book->is_late = $this->isLate($book);
                    return $book;
                });

            return view('admin.peminjaman', [
                'peminjaman' => $books,
            ]);
        } else return redirect()->back();
    }

    function peminjamanUpdate(Request $request)
    {
        $status = base64_decode($request->status);
        $peminjaman = Peminjaman::find($request->id);

        switch ($status) {
            case config('constants.peminjaman.status.1'):
                // do nothing
                break;
            case config('constants.peminjaman.status.2'):
                $peminjaman->update([
                    'status' => config('constants.peminjaman.status.2')
                ]);
                break;
            case config('constants.peminjaman.status.3'):
                $book = Book::find($peminjaman->book_id);

                $book->stock = $book->stock + 1;
                $book->save();

                $peminjaman->update([
                    'status' => config('constants.peminjaman.status.3')
                ]);
                break;

            case config('constants.peminjaman.status.4'):
                # code...
                break;

            case config('constants.peminjaman.status.5'):
                $peminjaman->update([
                    'status' => config('constants.peminjaman.status.5')
                ]);
                break;

                // pengembalian
            case config('constants.peminjaman.status.6'):
                $book = Book::find($peminjaman->book_id);

                $book->stock = $book->stock + 1;
                $book->save();

                $peminjaman->update([
                    'status' => config('constants.peminjaman.status.6')
                ]);
                break;

            default:
                # code...
                break;
        }

        return redirect(route('peminjaman.update'));
    }



    // === CATEGORY ===

    function showCategoryPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            $data = Category::all();
            return view('book.category.list', [
                'paginator' => $data
            ]);
        }
        return redirect()->back();
    }

    function addCategory(Request $request, UserProfileProvider $UserProfileProvider)
    {
        if (!$UserProfileProvider->isAdmin()) return redirect()->back();

        try {
            $request->validate([
                'category' => ['required', 'string', 'max:50', 'unique:' . Category::class],
            ], [
                'category.required'             => 'Kategori perlu diisi.',
                'category.unique'               => 'Kategori tidak boleh sama.',
            ]);

            Category::create([
                'category' => $request->category
            ]);

            return redirect(route('category'))->with('success', 'Sukses menambahkan buku.');
        } catch (ValidationException $e) {
            return redirect(route('category'))->withErrors([
                'errors'    => $e->getMessage(),
            ]);
        } catch (Exception $e) {
            return redirect(route('category'))->withErrors([
                'errors'    => 'Terjadi sebuah kesalahan.',
            ]);
        }
    }

    function deleteCategory(Request $request, UserProfileProvider $userProfileProvider)
    {
        if ($userProfileProvider->isAdmin()) {
            $category = Category::findOrFail($request->id);
            $category->delete();

            return redirect()->route('category')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            $data = Category::all();
            return view('book.category.list', [
                'paginator' => $data
            ]);
        };
    }

    function showCategoryApi()
    {
        $categories = Category::all()->pluck('category');;
        return $categories->toJson();
    }
}
