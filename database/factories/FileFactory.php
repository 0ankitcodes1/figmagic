<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = File::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->name,
            "creator_identifier" => Str::random(32),
            "from" => "text-api",
            "resource_identifier" => Str::random(32),
            "identifier" => Str::random(32),
            "status" => "null"
        ];
    }
}
