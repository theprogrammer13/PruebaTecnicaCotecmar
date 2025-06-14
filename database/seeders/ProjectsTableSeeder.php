<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        Project::truncate();

        $projects = [
            ['id' => 'BICM', 'name' => 'Oceanográfico'],
            ['id' => 'BALC', 'name' => 'Bloque DA'],
            ['id' => 'OPV', 'name' => 'Offshore'],
            ['id' => 'BRF', 'name' => 'Recifluvial'],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}