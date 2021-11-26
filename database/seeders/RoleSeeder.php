<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::factory([
            'slug' => 'administrator',
            'name' => 'Администратор',
            'permissions' => [
                'platform.index' => 1,
                'platform.systems.roles' => 1,
                'platform.systems.users' => 1,
                'platform.systems.manager' => 1,
                'platform.systems.attachment' => 1,
                'platform.systems.settings' => 1,
                'platform.systems.import' => 1,
                'platform.elements.banners' => 1,
                'platform.elements.category' => 1,
                'platform.elements.products' => 1,
                'platform.elements.sellers' => 1,
                'platform.elements.discounts' => 1,
                'platform.elements.orders' => 1,

            ],
        ])->create();
        Role::factory([
            'slug' => 'manager',
            'name' => 'Менеджер',
            'permissions' => [
                'platform.index' => 1,
                'platform.systems.manager' => 1,
                'platform.systems.attachment' => 1,

            ],
        ])->create();
        Role::factory([
            'slug' => 'user',
            'name' => 'Пользователь',
            'permissions' => [
                'platform.index' => 1,
                'platform.systems.user' => 1,
                'platform.systems.attachment' => 1,

            ],
        ])->create();
    }
}
