<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'building_id' => Building::factory(),
        ];
    }
}
