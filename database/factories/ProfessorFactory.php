<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professor>
 */
class ProfessorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'department_id' => Department::inRandomOrder()->first()?->id ?? Department::factory(),    //ดึงอันแรกมาและดึง id มา ถ้าไม่มีให้สร้างใหม่ขึ้นมา 1 อัน
           'prefix' => $this->faker->randomElement(['ดร.', 'ผศ.ดร.', 'รศ.ดร.', 'ศ.']),
           'first_name' => $this->faker->firstName,
           'last_name' => $this->faker->lastName

        ];
    }
}
