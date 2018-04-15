<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Note;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function index(User $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can view the note.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function view(User $user, Note $note)
    {
        return $note->user_id == $user->id;
    }

    /**
     * Determine whether the user can create notes.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->id > 0;
    }

    /**
     * Determine whether the user can update the note.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function update(User $user, Note $note)
    {
        return $user->id == $note->user_id;
    }

    /**
     * Determine whether the user can delete the note.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Note  $note
     * @return mixed
     */
    public function delete(User $user, Note $note)
    {
        return $user->id == $note->user_id;
    }
}
