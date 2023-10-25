<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    protected  $users=[
        [
            'name'=>'Admin',
            'email'=>'admin@admin.com',
            'password'=>'password',
        ]
    ];//assuming Later we want to add Multiple admins.
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->users as $user){
            User::create($user);
        }
    }
}
