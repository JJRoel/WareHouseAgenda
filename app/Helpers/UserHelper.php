<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function getUserId()
    {
        return Auth::id() ?? 1; // Default to user ID 1 if no user is authenticated
    }
}