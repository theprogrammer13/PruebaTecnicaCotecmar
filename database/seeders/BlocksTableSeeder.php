<?php

namespace Database\Seeders;

use App\Models\Block;
use Illuminate\Database\Seeder;

class BlocksTableSeeder extends Seeder
{
    public function run()
    {
        Block::truncate();

        $blocks = [
            ['id' => '130-1110', 'name' => '1110', 'project_id' => 'BICM'],
            ['id' => '135-1110', 'name' => '2210', 'project_id' => 'BALC'],
            ['id' => '130-3510', 'name' => '3510', 'project_id' => 'BICM'],
            ['id' => '130-3610', 'name' => '3610', 'project_id' => 'BICM'],
            ['id' => '135-3310', 'name' => '3310', 'project_id' => 'BALC'],
            ['id' => '100-2210', 'name' => '2210', 'project_id' => 'OPV'],
        ];

        foreach ($blocks as $block) {
            Block::create($block);
        }
    }
}