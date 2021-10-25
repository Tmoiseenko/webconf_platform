<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchid\Platform\Models\Role;

class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => 'guest',
            'name' => 'Guest',
            'permissions' => [
                'guest' => 1
            ]
        ];
    }
}

