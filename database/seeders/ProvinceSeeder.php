<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinceSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $province = Province::create(['name' => 'بوشهر', 'slug' => 'bushehr']);
            $province->cities()->create(['name' => 'بندربوشهر', 'slug' => 'bandarbushehr']);
        });
    }
}
