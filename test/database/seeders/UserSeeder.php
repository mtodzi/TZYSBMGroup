<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin31',
            'email' => 'admin31@gmail.com',
            'password' => Hash::make('123'),
        ]);
        User::factory()
            ->times(10)
            ->create();
    }
}
