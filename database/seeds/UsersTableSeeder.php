<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $password = '123456';
        $password_salt = uniqid();
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'unique_id' => str_random(15),
            'password' => md5($password . $password_salt),
            'password_salt' => $password_salt,
            'is_verified' => 1,
            'is_admin' => 1,
        ]);
        $password_salt = uniqid();
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'unique_id' => str_random(15),
            'password' => md5($password . $password_salt),
            'password_salt' => $password_salt,
            'is_verified' => 1,
            'is_admin' => 0,
        ]);
    }

}
