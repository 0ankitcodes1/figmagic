<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Creator;
use App\Models\Temporary;
use App\Models\File;
use App\Models\Admin;
use App\Models\Collaborator;
use App\Models\WebInfo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Creator::factory(20)->create();
        // Temporary::factory(10)->create();
        File::factory(20)->create();
        // Collaborator::factory(20)->create();

        // Admin::factory(1)->create();
        // WebInfo::factory(1)->create();
    }
}
