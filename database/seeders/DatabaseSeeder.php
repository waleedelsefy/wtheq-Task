<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Product;
use Database\Factories\UserFactory;
use Database\Factories\ProductFactory;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        {
            $actions = ['.index', '.store', '.show', '.update', '.destroy'];

            $tables = [
                'products',
                'orders',
                'users'
              ];

            $permissions[] = ['guard_name' => 'api', 'name' => 'products'];

            foreach ($tables as $table)
                foreach ($actions as $action)
                    $permissions[] = ['guard_name' => 'api', 'name' => $table . $action];

            \Spatie\Permission\Models\Permission::insert($permissions);

            $roles = [
                [
                    'role' => ['guard_name' => 'api', 'name' => 'admin'],
                    'permissions' => collect($permissions)->pluck('name')->all()
                ],
                [
                    'role' => ['guard_name' => 'api', 'name' => 'trader'],
                    'permissions' => [
                        'products.index',
                        'products.store',
                        'products.show',
                        'products.update',
                        'orders.show',
                        'orders.store',
                        'orders.update',
                        'orders.destroy',
                        ]
                ],
                [
                    'role' => ['guard_name' => 'api', 'name' => 'customer'],
                    'permissions' => [
                        'products.index',
                        'products.show',
                        'orders.show',
                        'orders.store',
                        'orders.update',
                        'orders.destroy',

                    ]
                ],
            ];

            // \Spatie\Permission\Models\Role::insert($roles);

            foreach ($roles as $value)
                \Spatie\Permission\Models\Role::create($value['role'])->givePermissionTo($value['permissions']);
        }


        User::create([
            'name' => 'admin',
            'avatar' => null,
            'email' => 'admin@test.com',
            'email_verified_at' => now(),
            'is_active' => 1,
            'password' => bcrypt('123456'),
        ])->assignRole('admin');

        \Database\Factories\UserFactory::new()->count(5)->create();
        \Database\Factories\ProductFactory::new()->count(50)->create();

    }
}

