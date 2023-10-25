<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    protected $model = Company::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company,
            'email' => fake()->unique()->safeEmail,
            'logo' => 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name='.fake()->company, // Replace with your actual image path
            'website' => fake()->url,
        ];
    }
}
