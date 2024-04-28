<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(100)->create([
            'password' => '123456',
        ]);

        Admin::factory()->create([
            'name' => 'Huy Na',
            'email' => 'giahuy2k3best@gmail.com',
            'password' => bcrypt('123456') // Encrypt the password
        ]);
        Admin::factory()->create([
            'name' => 'Dấu câu',
            'email' => 'giahuytest@gmail.com',
            'password' => bcrypt('123456') // Encrypt the password
        ]);
    }
}
