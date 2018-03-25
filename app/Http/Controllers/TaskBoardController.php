<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskBoardController extends Controller
{
    public function index()
    {
        return view('task_boards/index');
    }
}
