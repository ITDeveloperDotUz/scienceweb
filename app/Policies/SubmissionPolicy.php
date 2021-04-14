<?php

namespace App\Policies;

use App\Models\Submission;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubmissionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return $user->can('create submission');
    }

    public function read(User $user)
    {
        return $user->can('read submission');
    }

    public function update(User $user, Submission $post)
    {
        return $user->can('update submission');
    }

    public function delete(User $user, Submission $post)
    {
        return $user->can('delete submission');
    }
}
