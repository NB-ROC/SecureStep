<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Hoofd test user
        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'firstname' => 'Test',
                'middlename' => null,
                'lastname'  => 'User',
                'password'  => 'password', // NIET hashen
                'email_verified_at' => now(),
            ]
        );

        // vaste gebruikers
        $fixedUsers = [
            ['firstname' => 'Alice',   'middlename' => null, 'lastname' => 'Janssen', 'email' => 'alice@example.com'],
            ['firstname' => 'Bob',     'middlename' => null, 'lastname' => 'de Vries', 'email' => 'bob@example.com'],
            ['firstname' => 'Charlie', 'middlename' => null, 'lastname' => 'Bakker', 'email' => 'charlie@example.com'],
            ['firstname' => 'Diana',   'middlename' => null, 'lastname' => 'Peters', 'email' => 'diana@example.com'],
            ['firstname' => 'Eren',    'middlename' => null, 'lastname' => 'Yeager', 'email' => 'eren@example.com'],
        ];

        foreach ($fixedUsers as $data) {
            User::firstOrCreate(
                ['email' => $data['email']],
                [
                    'firstname' => $data['firstname'],
                    'middlename' => $data['middlename'],
                    'lastname'  => $data['lastname'],
                    'password'  => 'password', // NIET hashen
                    'email_verified_at' => now(),
                ]
            );
        }

        // extra random users
        User::factory(20)->create();
    }
}
