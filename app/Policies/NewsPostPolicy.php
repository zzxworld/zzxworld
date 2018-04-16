<?php

namespace App\Policies;

use App\Models\User;
use App\Models\NewsPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsPostPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        return $user->isRoot;
    }

    /**
     * Determine whether the user can view the NewsPost.
     *
     * @param  \App\Models\User  $user
     * @param  \App\NewsPost  $newsPost
     * @return mixed
     */
    public function view(User $user, NewsPost $newsPost)
    {

    }

    /**
     * Determine whether the user can create newsPosts.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the newsPost.
     *
     * @param  \App\Models\User  $user
     * @param  \App\NewsPost  $newsPost
     * @return mixed
     */
    public function update(User $user, NewsPost $newsPost)
    {
        //
    }

    /**
     * Determine whether the user can delete the newsPost.
     *
     * @param  \App\Models\User  $user
     * @param  \App\NewsPost  $newsPost
     * @return mixed
     */
    public function delete(User $user, NewsPost $newsPost)
    {
        //
    }
}
