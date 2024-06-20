<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookCategory;
use App\Providers\UserProfileProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    function showAddBookPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('book.add', ['success' => false]);
        } return redirect()->back();
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
            'isbn' => ['nullable', 'string', 'max:13'],
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
        foreach ($request->categories as $idCategory) {
            BookCategory::create([
                'id_book' => $book->id,
                'id_category' => $idCategory
            ]);
        }

        return view('book.add', ['success' => true]);
    }

    function showPeminjamanPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('admin.peminjaman');
        } else return redirect()->back();
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

            return redirect()->route('listBook')->with(['success' => 'Data Berhasil Dihapus!']);
        } else return redirect()->back();
    }

    function showCategoryPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {

            return view('book.category.list', ['success' => false]);
        } return redirect()->back();
    }
}
