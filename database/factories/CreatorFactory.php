<?php

namespace Database\Factories;

use App\Models\Creator;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class CreatorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Creator::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "email" => $this->faker->email,
            "password" => Hash::make(Str::random(10)),
            "companyName" => $this->faker->name,
            "role" => $this->faker->word,
            "token" => (string)Str::random(100),
            "profilePic" => env('APP_URL').'images/profile/'.rand(1,9),
            "apiLimiter" => rand(1000, 10000),
            "verificationCode" => Hash::make(Str::random(6)),
            "shareCount" => rand(1, 100),
            "status" => "not verified",
            "identifier" => Str::random(32)
        ];
    }
}
