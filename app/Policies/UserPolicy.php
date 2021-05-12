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
        /**
         * 这里有一个问题，postgresql中boolean类型存储false的是字符f，存储true的是字符t, 因此在这里需要做一个环境判断
         */
        if (getenv('IS_IN_HEROKU')) {
            // 数据库使用的是pg
            $userflag = false;
            if ($currentUser->is_admin == 't') {
                $userflag = true;
            }
            return ($userflag && $currentUser->id !== $user->id) ? Response::allow() : Response::deny('您无权限进行此项操作');

        } else {
            // 数据库使用的是mysql
            return ($currentUser->is_admin && $currentUser->id !== $user->id) ? Response::allow() : Response::deny('您无权限进行此项操作');
        }
    }


    /**
     * 自己不能关注自己哦
     * @param User $currentUser
     * @param User $user
     * @return bool
     */
    public function follow(User $currentUser, User $user)
    {
        return $currentUser->id !== $user->id;
    }
}
