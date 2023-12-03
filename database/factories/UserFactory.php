<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Faker\Generator as Faker;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
        'name' => $this->faker->name,
        'avatar' => $this->faker->imageUrl(),
        'email' => $this->faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'),
        'remember_token' => Str::random(10),
    ];
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $roles = ['customer', 'trader'];
            $randomRole = $roles[array_rand($roles)];
            $user->assignRole($randomRole);
        });
    }
}
