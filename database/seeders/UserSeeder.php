<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = User::create([
            'name' => 'alex',
            'email' => 'alex@example.com',
            'password' => Hash::make('password'),
        ]);


        $token = $user->createToken('test-token')->plainTextToken;


        echo "User: alex@example.com, Token: $token\n";


        User::factory()->count(5)->create()->each(function ($user) {
            $token = $user->createToken('test-token')->plainTextToken;
            echo "User: {$user->email}, Token: $token\n";
        });


//        $this->call([
//            UserSeeder::class,
//        ]);
    }
}
