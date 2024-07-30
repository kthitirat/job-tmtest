<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Professor;
use App\Models\Department;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        professor::factory()->create([
            'prefix' => 'ดร.',
            'first_name' => 'มรุต',
            'last_name' => 'กลัดเจริญ',
            'department_id' => Department::first()->id ?? Department::factory()
        
        ]);
        professor::factory()->count(10)->create();

        $professors = Professor::all();
        foreach ($professors as $professor)
        $professor->addMedia(storage_path('seed/mock_professor_image.jpg'))->preservingOriginal()
        ->toMediaCollection(Professor::MEDIA_COLLECTION_IMAGE);
    }
}
