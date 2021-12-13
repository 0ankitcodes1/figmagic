<?php

namespace Database\Factories;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => "Admin Panel",
            "email" => "admin@nizeed.com",
            "password" => Hash::make("1234"),
            "companyName" => "Nizeed",
            "role" => "Admin",
            "token" => (string)Str::random(100),
            "profilePic" => env('APP_URL').'images/profile/'.rand(1,9),
            "apiLimiter" => rand(100000, 999999),
            "verificationCode" => "",
            "shareCount" => rand(1000, 9999),
            "status" => "verified",
            "identifier" => Str::random(32)
        ];
    }
}
