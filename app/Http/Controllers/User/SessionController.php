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

    public function user(Request $request)
    {
        $user = $request->user();

        return [
            'message' => 'ok',
            'user' => $user ? array_only($user->toArray(), ['name']) : null,
        ];
    }
}
