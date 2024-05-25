<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserProfileProvider {
    function getUserRole(): User {
        $role = Auth::user()->role;
        return $role;
    }

    function isAdmin(): bool {
        $role = Auth::user()->role;
        return strtolower($role) == 'a';
    }
}