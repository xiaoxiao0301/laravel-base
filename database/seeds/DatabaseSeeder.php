<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard(); // 临时关闭批量插入的保护

        $this->call(UsersTableSeeder::class);
        $this->call(StatusesTableSeeder::class);

        Model::reguard();
    }
}
