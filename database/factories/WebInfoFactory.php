<?php

namespace Database\Factories;

use App\Models\WebInfo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

class WebInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WebInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = array("link", "social-link");
        $name = array("instagram", "twitter", "facebook", "email", "new-feature-email", "report-bug-email");
        $information = array("http://social-link/", "http://link.com/");

        DB::table('web_infos')->insert(
            [
                "type" => $type[1],
                "name" => $name[0],
                "information" => "http://"
            ],
            [
                "type" => $type[1],
                "name" => $name[1],
                "information" => "http://"
            ],
            [
                "type" => $type[1],
                "name" => $name[2],
                "information" => "http://"
            ],
            [
                "type" => $type[1],
                "name" => $name[3],
                "information" => "http://"
            ],
            [
                "type" => $type[1],
                "name" => $name[4],
                "information" => "http://"
            ]
        );

    }
}
