<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::factory()->create([
            'name' => 'คณะวิทยาการจัดการ'
        ]);

        Department::factory()->count(10)->create();    //ข้อมูลตัวอย่าง 10 ข้อมูล
    }
}
