<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function check(Request $request)
    {
        $user = $request->user();
        $isLogined = $user ? true : false;
        return ['message' => 'ok', 'is_logined' => $isLogined];
    }
}
