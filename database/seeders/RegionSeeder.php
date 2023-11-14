<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Region;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::insert([
            ['name' => 'a'],
            ['name' => 'b'],
            ['name' => 'c'],
            ['name' => 'd']
        ]);
    }
}
