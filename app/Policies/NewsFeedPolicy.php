<?php

namespace App\Policies;

use App\Models\User;
use App\Models\NewsFeed;
use Illuminate\Auth\Access\HandlesAuthorization;

class NewsFeedPolicy
{
    use HandlesAuthorization;

    public function before($user)
    {
        return $user->isRoot;
    }

    /**
     * Determine whether the user can view the newsFeed.
     *
     * @param  \App\Models\User  $user
     * @param  \App\NewsFeed  $newsFeed
     * @return mixed
     */
    public function view(User $user, NewsFeed $newsFeed)
    {

    }

    /**
     * Determine whether the user can create newsFeeds.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the newsFeed.
     *
     * @param  \App\Models\User  $user
     * @param  \App\NewsFeed  $newsFeed
     * @return mixed
     */
    public function update(User $user, NewsFeed $newsFeed)
    {
        //
    }

    /**
     * Determine whether the user can delete the newsFeed.
     *
     * @param  \App\Models\User  $user
     * @param  \App\NewsFeed  $newsFeed
     * @return mixed
     */
    public function delete(User $user, NewsFeed $newsFeed)
    {
        //
    }
}
