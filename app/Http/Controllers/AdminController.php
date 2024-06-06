<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Providers\UserProfileProvider;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    function showAddBookPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('book.add', [ 'success' => false ]);
        }
    }

    function addBook(Request $request, UserProfileProvider $UserProfileProvider)
    {
        if (!$UserProfileProvider->isAdmin()) return;

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'cover' => ['required', 'string', 'max:255'],
            'publishing_year' => ['integer', 'max:4'],
            'ISBN' => ['integer', 'max:30'],
            'language' => ['string', 'max:30'],
        ]);

        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'description' => $request->description,
            'publisher' => $request->publisher,
            'cover' => $request->cover,
            'publishing_year' => $request->publishing_year,
            'ISBN' => $request->ISBN,
            'language' => $request->language
        ]);

        return redirect(route('addBook', [ 'success' => true ]));
    }

    function showPeminjamanPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('admin.peminjaman');
        }
    }
}
