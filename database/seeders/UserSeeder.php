<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug', 'administrator')->pluck('id')->toArray();
        $managerRole = Role::where('slug', 'manager')->pluck('id')->toArray();
        $userRole = Role::where('slug', 'user')->pluck('id')->toArray();
        User::factory([
            'name' => 'Admininstrator',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ])
            ->create()
            ->roles()
            ->syncWithoutDetaching(array_merge($adminRole, $managerRole));

        User::factory([
            'name' => 'Анна Новикова',
            'email' => 'event.af@ya.ru',
            'email_verified_at' => now(),
            'password' => bcrypt('B8VnN0se'),
            'remember_token' => Str::random(10),
        ])
            ->create()
            ->roles()
            ->attach($managerRole);

        User::factory([
            'name' => 'Ксения Синицкая',
            'email' => 'ksinitskaya@infocell.ru',
            'email_verified_at' => now(),
            'password' => bcrypt('UeNxODhY'),
            'remember_token' => Str::random(10),
        ])
            ->create()
            ->roles()
            ->attach($managerRole);

        User::factory([
            'name' => 'Светлана Смазанова',
            'email' => 'ssmazanova@infocell.ru',
            'email_verified_at' => now(),
            'password' => bcrypt('NxpSe6Hi'),
            'remember_token' => Str::random(10),
        ])
            ->create()
            ->roles()
            ->attach($managerRole);

        User::factory([
            'name' => 'Anna Novikova',
            'email' => '89064039093a@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('vatlE76H'),
            'remember_token' => Str::random(10),
        ])
            ->create()
            ->roles()
            ->attach($userRole);
    }
}
