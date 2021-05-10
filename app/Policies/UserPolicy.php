<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class UserPolicy
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

    /**
     * @param User $currentUser 当前登录用户实例
     * @param User $user 进行授权的用户
     * @return Response
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id ? Response::allow() : Response::deny('您无权限进行此项操作');
    }

    /**
     * @param User $currentUser 当前登录用户实例
     * @param User $user 进行授权的用户
     * @return Response
     */
    public function destroy(User $currentUser, User $user)
    {
        return ($currentUser->is_admin && $currentUser->id !== $user->id) ? Response::allow() : Response::deny('您无权限进行此项操作');
    }
}
