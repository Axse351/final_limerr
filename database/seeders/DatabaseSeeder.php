<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $request = [
            [
                "name" => "staff",
                "email" => "axsenathanzx@gmail.com",
                "password" => Hash::make("12345"),
                "role" => "staff",
                "namawahana" => "makan",
            ],
            [
                "name" => "example",
                "email" => "admin@gmail.com",
                "password" => Hash::make("12345"),
                "role" => "admin",
                "namawahana" => "none",
            ],
            [
                "name" => "example",
                "email" => "scan1@gmail.com",
                "password" => Hash::make("12345"),
                "role" => "scan1",
                "namawahana" => "biang lala",
            ],
            [
                "name" => "example",
                "email" => "scan2@gmail.com",
                "password" => Hash::make("12345"),
                "role" => "scan2",
                "namawahana" => "komedi putar",
            ],
        ];

        User::insert($request);
    }
}
