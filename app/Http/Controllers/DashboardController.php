<?php

namespace App\Http\Controllers;

use App\Providers\UserProfileProvider;

class DashboardController extends Controller
{
    function showDashboard(UserProfileProvider $UserProfileProvider)
    {
        if ($UserProfileProvider->isAdmin()) {
            return 'Hello admin';
        } else {
            return view('user.dashboard');
        }
    }
}
