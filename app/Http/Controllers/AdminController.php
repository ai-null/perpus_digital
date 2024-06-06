<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Providers\UserProfileProvider;
use Exception;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    function showAddBookPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('book.add', ['success' => false]);
        }
    }

    function addBook(Request $request, UserProfileProvider $UserProfileProvider)
    {
        if (!$UserProfileProvider->isAdmin()) return;

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'publisher' => ['required', 'string', 'max:255'],
            'cover' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'publishing_year' => ['nullable', 'integer', 'not_in:0'],
            'ISBN' => ['nullable', 'integer', 'max:30'],
            'language' => ['nullable', 'string', 'max:30'],
        ]);

        $imageName = time() . '.' . $request->cover->extension();
        $request->cover->move(public_path('img/cover/book_cover'), $imageName);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'publisher' => $request->publisher,
            'cover' => $imageName,
            'publishing_year' => $request->publishing_year,
            'ISBN' => $request->ISBN,
            'language' => $request->language
        ]);

        return view('addBook', ['success' => true]);
    }

    function showPeminjamanPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('admin.peminjaman');
        }
    }
}
