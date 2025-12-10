<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name_en' => 'Newbie', 'name_fa' => 'تازه وارد', 'is_global' => true],
            ['name_en' => 'SuperAdmin', 'name_fa' => 'سوپر ادمین', 'is_global' => true],
            ['name_en' => 'Founder', 'name_fa' => 'موسس', 'is_global' => true],
            ['name_en' => 'Manager', 'name_fa' => 'مدیر'],
            ['name_en' => 'Assistant', 'name_fa' => 'مسئول اداری'],
            ['name_en' => 'Accountant', 'name_fa' => 'حسابدار'],
            ['name_en' => 'Teacher', 'name_fa' => 'مربی'],
            ['name_en' => 'Student', 'name_fa' => 'کارآموز'],
            ['name_en' => 'QuestionMaker', 'name_fa' => 'طراح سوال', 'is_global' => true],
            ['name_en' => 'QuestionAuditor', 'name_fa' => 'ممیز سوال', 'is_global' => true],
            ['name_en' => 'Examiner', 'name_fa' => 'آزمونگر', 'is_global' => true],
            ['name_en' => 'Marketer', 'name_fa' => 'بازاریاب', 'is_global' => true],
            ['name_en' => 'JobSeeker', 'name_fa' => 'کارجو', 'is_global' => true],
            ['name_en' => 'Examinee', 'name_fa' => 'آزمون دهنده'],
            ['name_en' => 'Employer', 'name_fa' => 'کارفرما', 'is_global' => true],
        ];
        foreach ($roles as $data) {
            Role::create($data);
        }
    }
}
