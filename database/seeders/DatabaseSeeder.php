<?php

namespace Database\Seeders;
use App\Models\BranchRoleUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ProvinceSeeder::class,
            BranchSeeder::class,
            RoleSeeder::class,
            BranchRoleUserSeeder::class,
        ]);

    }
}
