<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Peminjaman;
use App\Models\User;
use App\Providers\UserProfileProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class DashboardController extends Controller
{
    function showDashboard(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('admin.dashboard');
        } else {
            $paginator = Book::paginate(8)->onEachSide(-1);

            // Get the S3 URL from the environment
            $s3Url = env('AWS_STORAGE_PATH');

            // Transform the cover URLs
            foreach ($paginator->items() as $book) {
                $book->cover = $s3Url . '/public/covers/' . $book->cover;
            }

            return view('user.dashboard', [
                'paginator' => $paginator,
            ]);
        }
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
            'status' => config('constants.peminjaman.status.requested')
        ]);

        return redirect()->route('user.peminjaman.list', [
            'books' => $user->books()->get()
        ])->with(['succes' => true]);
    }

    public function showPeminjamanPage() {
        $user = User::find(Auth::user()->id);
        
        return view('user.peminjaman.list', [
            'books' => $user->books()->get()
        ])->with(['succes' => true]);
    }
}
