<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LinuxCommand;

/**
 * Linux 命令
 */
class LinuxCommandController extends Controller
{
    public function index()
    {
        $commands = LinuxCommand::orderBy('published_at', 'desc')->get();
        return view('linux.commands.index', ['commands'=>$commands]);
    }

    public function show(LinuxCommand $command)
    {
        return view('linux.commands.show', ['command'=>$command]);
    }

    public function storeComment(Request $request, LinuxCommand $command)
    {
        $this->validate($request, [
            'content' => 'required',
        ]);

        $comment = $command->comments()->create([
            'user_id' => $request->user() ? $request->user()->id : 0,
            'ip' => $request->ip(),
        ]);

        $comment->saveText($request->input('content'));

        return redirect('linux/commands/'.$command->name.'#comment-'.$comment->id);
    }
}
