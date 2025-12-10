<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            $user = User::create([
                'user_name' => 'test',
                'password'  => ('test'),
            ]);

            $user->profile()->create([
                'identifier_type' => 'national_id',
                'n_code' => '2063531218',
                'f_name_fa' => 'یاسر',
                'l_name_fa' => 'بیشه سری',
            ]);

            $user->contacts()->createMany([
                ['mobile_nu' => '09177755924', 'verified' => true],
                ['mobile_nu' => '09034336111', 'verified' => true],
            ]);
        });
    }
}
