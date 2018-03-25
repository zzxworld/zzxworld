<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotebookController extends Controller
{
    public function index()
    {
        return view('notebooks.index');
    }
}
