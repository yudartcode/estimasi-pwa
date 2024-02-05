<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash as pswd;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "nama" => "Risky Admin",
            "email" => "admin@mail.com",
            "username" => "admin",
            "password" => pswd::make("admin"),
            "role" => "admin",
        ]);
    }
}