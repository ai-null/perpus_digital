<?php

namespace App\Http\Controllers;

use App\Providers\UserProfileProvider;

class DashboardController extends Controller
{
    function showDashboard(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return view('admin.dashboard');
        } else {
            return view('user.dashboard');
        }
    }
}
