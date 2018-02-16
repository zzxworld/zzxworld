<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinuxCommand;

/**
 * Linux 命令
 */
class LinuxCommandController extends Controller
{
    public function show(LinuxCommand $command)
    {
        return view('linux.commands.show', ['command'=>$command]);
    }
}
