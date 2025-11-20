<?php

namespace Database\Seeders;

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
        // vaste test user om in te loggen
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        // een paar vaste namen
        $fixedUsers = [
            ['name' => 'Alice Janssen',   'email' => 'alice@example.com'],
            ['name' => 'Bob de Vries',    'email' => 'bob@example.com'],
            ['name' => 'Charlie Bakker',  'email' => 'charlie@example.com'],
            ['name' => 'Diana Peters',    'email' => 'diana@example.com'],
            ['name' => 'Eren Yeager',     'email' => 'eren@example.com'],
        ];

        foreach ($fixedUsers as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'name' => $data['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
        }

        // extra random users
        User::factory(20)->create();
    }
}
