<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'slug' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'type' => User::ADMIN,
        ]);

        User::factory()->create([
            'name' => 'John Doe',
            'username' => 'johndoe',
            'slug' => 'john-doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'type' => User::DEFAULT,
        ]);

        User::factory()->create([
            'name' => 'Naya Doe',
            'username' => 'mayadoe',
            'slug' => 'maya-doe',
            'email' => 'maya@example.com',
            'password' => bcrypt('password'),
            'type' => User::DEFAULT,
        ]);

        User::factory()->count(10)->create();
    }
}
