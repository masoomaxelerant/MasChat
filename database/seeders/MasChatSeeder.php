<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Maschat;
use Illuminate\Database\Seeder;

class MasChatSeeder extends Seeder
{
    public function run(): void
    {
        // Create a few sample users if they don't exist
        $users = User::count() < 3
                    ? collect([
                        User::create([
                            'name' => 'Deepak Kumar',
                            'email' => 'deepak@example.com',
                            'password' => bcrypt('test1234'),
                        ]),
                        User::create([
                            'name' => 'Suraj',
                            'email' => 'suraj@example.com',
                            'password' => bcrypt('test1234'),
                        ]),
                        User::create([
                            'name' => 'Binny',
                            'email' => 'binny@example.com',
                            'password' => bcrypt('test1234'),
                        ]),
                    ])
                    : User::take(3)->get();

        // Sample Maschat messages
        $maschats = [
            'Just discovered Laravel - where has this been all my life? 🚀',
            'Building something cool with MasChat today!',
            'Laravel\'s Eloquent ORM is pure magic ✨',
            'Deployed my first app with Laravel Cloud. So smooth!',
            'Who else is loving Blade components?',
            'Friday deploys with Laravel? No problem! 😎',
        ];

        // Create Maschats for random users
        foreach ($maschats as $message) {
            $users->random()->maschat()->create([
                'message' => $message,
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }
    }
}