<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use App\Providers\UserProfileProvider;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
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

            return view('admin.dashboard', [
                'general' => [
                    'request' => $this->countByStatus($data, config('constants.peminjaman.status.1')),
                    'borrowed' => $this->countByStatus($data, config('constants.peminjaman.status.2')),
                    'vanished' => $this->countByStatus($data, config('constants.peminjaman.status.5')),
                    'accepted' => $this->countByStatus($data, config('constants.peminjaman.status.6')),
                ],
                'peminjaman' => $dataPeminjaman
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

        $user->books()->save($book, [
            'status' => config('constants.peminjaman.status.1')
        ]);

        return redirect()->route('user.peminjaman.list', [
            'books' => $user->books()->get()
        ])->with(['succes' => true]);
    }

    public function showPeminjamanPage()
    {
        $user = User::find(Auth::user()->id);

        return view('user.peminjaman.list', [
            'books' => $user->books()->get()
        ])->with(['succes' => true]);
    }
}
