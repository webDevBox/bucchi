<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(User::whereEmail('admin@gmail.com')->count() == 0)
        {
            User::updateOrCreate([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(123456),
                'role' => 0
            ]);
        }
        if(User::whereEmail('office@gmail.com')->count() == 0)
        {
            User::updateOrCreate([
                'name' => 'officer',
                'email' => 'office@gmail.com',
                'password' => bcrypt(123456),
                'role' => 1
            ]);
        }
    }
}
