<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Peminjaman;
use App\Models\User;
use App\Providers\UserProfileProvider;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends BaseController
{
    function showDashboard(Request $request, UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            $data = DB::table('peminjaman')
                ->whereIn('status', [
                    config('constants.peminjaman.status.1'),
                    config('constants.peminjaman.status.2'),
                    config('constants.peminjaman.status.5'),
                    config('constants.peminjaman.status.6'),
                ])->get();

            $dataPeminjaman = DB::table('peminjaman')
                ->select(
                    'peminjaman.id',
                    'peminjaman.created_at',
                    'peminjaman.status',
                    'peminjaman.return_at',
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

                $peminjaman = $dataPeminjaman->map(function($book) {
                    $book->is_late = $this->isLate($book);
                    return $book;
                });

            return view('admin.dashboard', [
                'general' => [
                    'request' => $this->countByStatus($data, config('constants.peminjaman.status.1')),
                    'borrowed' => $this->countByStatus($data, config('constants.peminjaman.status.2')),
                    'vanished' => $this->countByStatus($data, config('constants.peminjaman.status.5')),
                    'accepted' => $this->countByStatus($data, config('constants.peminjaman.status.6')),
                ],
                'peminjaman' => $peminjaman
            ]);
        } else {
            $categoryQueryParam = $request->query('category');
            $searchQueryParam = $request->query('search');

            if ($categoryQueryParam != null) {
                $category = Category::findOrFail($categoryQueryParam);
                $paginator = $category->books()->paginate(8)->onEachSide(-1);
            } else if ($searchQueryParam != null) {
                $paginator = DB::table('book')
                    ->whereAny([
                        'title',
                        'author',
                        'publisher',
                    ], 'LIKE', $searchQueryParam . '%')
                    ->paginate(8)->onEachSide(-1);
            } else {
                $paginator = Book::paginate(8)->onEachSide(-1);
            }

            // Get the S3 URL from the environment
            $s3Url = env('AWS_STORAGE_PATH');

            // Transform the cover URLs
            foreach ($paginator->items() as $book) {
                $book->cover = $s3Url . '/public/covers/' . $book->cover;
            }

            return view('user.dashboard', [
                'paginator' => $paginator,
                'categories' => Category::get(),
            ]);
        }
    }

    private function countByStatus(Collection $data, string $status): int
    {
        return $data->filter(function ($item) use ($status) {
            return $item->status == $status;
        })->count();
    }

    function showDetail(string $id)
    {
        $decodedId = base64_decode(strval($id));
        $book = Book::where('id', $decodedId)->first();
        $categories = $book->categories()->get();

        $book->cover = env('AWS_STORAGE_PATH') . '/public/covers/' . $book->cover;
        return view('book/detail', [
            'book' => $book,
            'categories' => $categories,
        ]);
    }

    public function borrow(string $bookId, Request $request)
    {
        $decodedId = base64_decode(strval($bookId));
        $book = Book::find($decodedId);

        if (0 >= $book->stock) {
            return redirect(route('book.detail', ['id' => $bookId]));
        }

        $user = User::find(Auth::user()->id);

        // create peminjaman data and decrease book stock
        $user->books()->save($book, [
            'status' => config('constants.peminjaman.status.1'),
            'created_at' => now()->toDateTimeString(),
            'return_at' => now()->addDays(7)->toDateTimeString(),
        ]);

        $book->stock = $book->stock - 1;
        $book->save();

        return redirect()->route('user.peminjaman.list', [
            'books' => $user->books()->get()
        ])->with('succes', true);
    }

    public function showPeminjamanPage()
    {
        $user = User::find(Auth::user()->id);
        $books = $user->books()->get()->map(function($book) {
            $book->is_late = $this->isLate($book->pivot);
            return $book;
        });
        
        return view('user.peminjaman.list', [
            'books' => $books
        ])->with('succes', true);
    }


    public function cancelBook(Request $request)
    {
        return $this->changeHistoryStatusFromUser($request->id, config('constants.peminjaman.status.0'));
    }

    // public function returnBook(Request $request)
    // {
    //     return $this->changeHistoryStatusFromUser($request->id, config('constants.peminjaman.status.4'));
    // }

    private function changeHistoryStatusFromUser(string $id, string $status)
    {
        $user = User::find(Auth::user()->id);
        $peminjaman = Peminjaman::find($id);

        // make sure user is the same as peminjaman data
        if ($peminjaman->user_id == $user->id) {
            $peminjaman->update([
                'status' => $status
            ]);

            if (config('constants.peminjaman.status.0')) {
                $book = Book::find($peminjaman->book_id);

                $book->stock = $book->stock + 1;
                $book->save();
            }

            return redirect(route('user.peminjaman.list'))->with('status', 'success');
        } else {
            return redirect()->route('user.peminjaman.list')->with('status', 'error');
        }
    }
}
