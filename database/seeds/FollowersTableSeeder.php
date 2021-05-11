<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        // 获取去掉id为1的所有用户组ID数组
        $followers = $users->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();

        // 关注除了1号用户以外的所有用户
        $user->follow($follower_ids);

        // 除了1号用户以外所有用户都关注1号
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
