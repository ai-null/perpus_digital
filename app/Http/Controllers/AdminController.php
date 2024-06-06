<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Providers\UserProfileProvider;

class AdminController extends Controller {
    
    function showAddBookPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('book.add');
        }
    }

    function showPeminjamanPage(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('admin.peminjaman');
        }
    }
}