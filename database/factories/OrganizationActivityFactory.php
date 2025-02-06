<?php

namespace Database\Factories;

use App\Models\OrganizationActivity;
use App\Models\Organization;
use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationActivityFactory extends Factory
{
    protected $model = OrganizationActivity::class;

    public function definition()
    {
        return [
            'organization_id' => Organization::factory(),
            'activity_id' => Activity::factory(),
        ];
    }
}
