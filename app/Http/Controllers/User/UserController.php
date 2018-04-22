<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('view', User::class);

        $users = User::paginate(50);

        return view('user.index', [
            'users' => $users,
        ]);
    }
}
