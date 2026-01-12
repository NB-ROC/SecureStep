<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'firstname' => 'Test',
                'middlename' => null,
                'lastname' => 'User',
                'password' => 'password', // NIET Hash::make
                'email_verified_at' => now(),
            ]
        );

        $fixedUsers = [
            ['firstname' => 'Alice', 'middlename' => null, 'lastname' => 'Janssen', 'email' => 'alice@example.com'],
            ['firstname' => 'Bob', 'middlename' => null, 'lastname' => 'de Vries', 'email' => 'bob@example.com'],
            ['firstname' => 'Charlie', 'middlename' => null, 'lastname' => 'Bakker', 'email' => 'charlie@example.com'],
        ];

        foreach ($fixedUsers as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'firstname' => $data['firstname'],
                    'middlename' => $data['middlename'],
                    'lastname' => $data['lastname'],
                    'password' => 'password', // NIET Hash::make
                    'email_verified_at' => now(),
                ]
            );
        }

        User::factory(20)->create();
    }
}
