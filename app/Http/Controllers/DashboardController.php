<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Providers\UserProfileProvider;

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

    function showDetail(string $id) {
        $decodedId = base64_decode(strval($id));
        $book = Book::where('id', $decodedId)->first();
        $book->cover = env('AWS_STORAGE_PATH') . '/public/covers/' . $book->cover;

        return view('book/detail', [
            'book' => $book
        ]);
    }
}
