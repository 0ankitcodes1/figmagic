<?php

namespace Database\Factories;

use App\Models\Temporary;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TemporaryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Temporary::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "data" => "https://source.unsplash.com/random",
            "type" => "image",
            "url" => "https://source.unsplash.com/",
            "status" => "",
            "identifier" => Str::random(32),
        ];
    }
}
