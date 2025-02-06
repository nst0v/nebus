<?php

namespace Database\Factories;

use App\Models\OrganizationPhone;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationPhoneFactory extends Factory
{
    protected $model = OrganizationPhone::class;

    public function definition()
    {
        return [
            'organization_id' => Organization::factory(),
            'phone' => $this->faker->phoneNumber,
        ];
    }
}
