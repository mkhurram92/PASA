<?php

namespace Database\Seeders;

use App\Models\SourceOfArrival;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SourceOfArrivalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SourceOfArrival::truncate();
        SourceOfArrival::create([
            "name"=> "International Ships"
        ]);
    }
}
