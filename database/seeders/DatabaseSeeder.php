<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
       
        $users = [
            ['Vo Ta Hoan', 'hoan-vo@dimage.co.jp', 'Admin', '123456'],
            ['Uong Hong Minh', 'minh-uong@dimage.co.jp', 'Manager', '123456'],
            ['Nguyen Kim Bao', 'bao-nguyen@dimage.co.jp', 'User', '123456'],
            ['Nguyen Duc Tung', 'tung-nguyen@dimage.co.jp', 'User', '123456'],
        ];
        foreach ($users as $user) {
            \App\Models\User::create([
                'name' => $user[0],
                'username' => $user[1],
                'role' => $user[2],
                'password' => bcrypt($user[3]),
            ]);
        }
    }
}