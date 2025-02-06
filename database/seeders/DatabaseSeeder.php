<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Building;
use App\Models\Activity;
use App\Models\Organization;
use App\Models\OrganizationPhone;
use App\Models\OrganizationActivity;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $building1 = Building::factory()->create([
            'address' => 'ул. Ленина, 45, Москва',
            'latitude' => 55.751244,
            'longitude' => 37.618423
        ]);
        $building2 = Building::factory()->create([
            'address' => 'пр. Мира, 78, Москва',
            'latitude' => 55.753215,
            'longitude' => 37.622504
        ]);
        $building3 = Building::factory()->create([
            'address' => 'ул. Тверская, 15, Москва',
            'latitude' => 55.755814,
            'longitude' => 37.617635
        ]);
        $building4 = Building::factory()->create([
            'address' => 'Кутузовский пр., 32, Москва',
            'latitude' => 55.757814,
            'longitude' => 37.619635
        ]);
        $building5 = Building::factory()->create([
            'address' => 'ул. Арбат, 24, Москва',
            'latitude' => 55.756814,
            'longitude' => 37.618635
        ]);
        $building6 = Building::factory()->create([
            'address' => 'Садовая-Кудринская ул., 11, Москва',
            'latitude' => 55.754814,
            'longitude' => 37.620635
        ]);

        $food = Activity::factory()->create(['name' => 'Еда']);
        $meat = Activity::factory()->create(['name' => 'Мясная продукция', 'parent_id' => $food->id]);
        $dairy = Activity::factory()->create(['name' => 'Молочная продукция', 'parent_id' => $food->id]);
        $bakery = Activity::factory()->create(['name' => 'Выпечка', 'parent_id' => $food->id]);

        $cars = Activity::factory()->create(['name' => 'Автомобили']);
        $trucks = Activity::factory()->create(['name' => 'Грузовые', 'parent_id' => $cars->id]);
        $passengerCars = Activity::factory()->create(['name' => 'Легковые', 'parent_id' => $cars->id]);
        $spareParts = Activity::factory()->create(['name' => 'Запчасти', 'parent_id' => $passengerCars->id]);
        $accessories = Activity::factory()->create(['name' => 'Аксессуары', 'parent_id' => $passengerCars->id]);

        $organizations = [
            Organization::factory()->create(['name' => 'Мясной двор', 'building_id' => $building1->id]),
            Organization::factory()->create(['name' => 'Молочная ферма', 'building_id' => $building1->id]),
            Organization::factory()->create(['name' => 'АвтоМир', 'building_id' => $building2->id]),
            Organization::factory()->create(['name' => 'Хлеб и Выпечка', 'building_id' => $building3->id]),
            Organization::factory()->create(['name' => 'Автозапчасти-Центр', 'building_id' => $building4->id]),
            Organization::factory()->create(['name' => 'Грузовой Автосервис', 'building_id' => $building5->id]),
            Organization::factory()->create(['name' => 'Молочный Комбинат', 'building_id' => $building6->id]),
            Organization::factory()->create(['name' => 'Мясокомбинат №1', 'building_id' => $building2->id]),
            Organization::factory()->create(['name' => 'АвтоАксессуары Люкс', 'building_id' => $building3->id]),
            Organization::factory()->create(['name' => 'Пекарня у Дома', 'building_id' => $building4->id])
        ];

        foreach ($organizations as $organization) {
            OrganizationPhone::factory()->create([
                'organization_id' => $organization->id,
                'phone' => '+7' . rand(900, 999) . rand(1000000, 9999999)
            ]);
        }

        OrganizationActivity::insert([
            ['organization_id' => $organizations[0]->id, 'activity_id' => $meat->id],
            ['organization_id' => $organizations[1]->id, 'activity_id' => $dairy->id],
            ['organization_id' => $organizations[2]->id, 'activity_id' => $cars->id],
            ['organization_id' => $organizations[3]->id, 'activity_id' => $bakery->id],
            ['organization_id' => $organizations[4]->id, 'activity_id' => $spareParts->id],
            ['organization_id' => $organizations[5]->id, 'activity_id' => $trucks->id],
            ['organization_id' => $organizations[6]->id, 'activity_id' => $dairy->id],
            ['organization_id' => $organizations[7]->id, 'activity_id' => $meat->id],
            ['organization_id' => $organizations[8]->id, 'activity_id' => $accessories->id],
            ['organization_id' => $organizations[9]->id, 'activity_id' => $bakery->id],
            ['organization_id' => $organizations[0]->id, 'activity_id' => $food->id],
            ['organization_id' => $organizations[1]->id, 'activity_id' => $food->id],
            ['organization_id' => $organizations[2]->id, 'activity_id' => $passengerCars->id],
            ['organization_id' => $organizations[3]->id, 'activity_id' => $food->id],
            ['organization_id' => $organizations[4]->id, 'activity_id' => $cars->id]
        ]);
    }
}
