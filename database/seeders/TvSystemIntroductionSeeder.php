<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TvSystemIntroduction;

class TvSystemIntroductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TvSystemIntroduction::insert([
            ['file' => null, 'type' => 1],
            ['file' => null, 'type' => 2],
            ['file' => null, 'type' => 3],
            ['file' => null, 'type' => 4],
        ]);
    }
}
