<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Models\Organization;

class OrganizationRepository
{
    private function formatOrganization($query)
    {
        return $query->with([
            'building:id,address,latitude,longitude',
            'phones:id,organization_id,phone',
            'activities:id,name,parent_id'
        ])->get()->map(function ($organization) {
            return [
                'id' => $organization->id,
                'name' => $organization->name,
                'building' => [
                    'address' => $organization->building->address,
                    'coordinates' => [
                        'latitude' => $organization->building->latitude,
                        'longitude' => $organization->building->longitude,
                    ]
                ],
                'phones' => $organization->phones->pluck('phone'),
                'activities' => $organization->activities->map(function ($activity) {
                    return [
                        'name' => $activity->name
                    ];
                })
            ];
        });
    }

    public function getByBuildingId($buildingId)
    {
        return $this->formatOrganization(
            Organization::where('building_id', $buildingId)
        );
    }

    public function getOrganizationsInRadius($latitude, $longitude, $radius)
    {
        return $this->formatOrganization(
            Organization::whereHas('building', function($query) use ($latitude, $longitude, $radius) {
                $query->whereRaw("(6371000 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) < ?",
                    [$latitude, $longitude, $latitude, $radius]
                );
            })
        );
    }

    public function getOrganizationsInRectangle($minLat, $maxLat, $minLng, $maxLng)
    {
        return $this->formatOrganization(
            Organization::whereHas('building', function($query) use ($minLat, $maxLat, $minLng, $maxLng) {
                $query->whereBetween('latitude', [$minLat, $maxLat])
                    ->whereBetween('longitude', [$minLng, $maxLng]);
            })
        );
    }

    public function getOrgById($id)
    {
        return $this->formatOrganization(
            Organization::where('id', $id)
        )->first();
    }

    public function getOrgByName($name)
    {
        return $this->formatOrganization(
            Organization::where('name', 'ilike', "%$name%")
                ->orWhere('name', 'ilike', str_replace(' ', '%', "%$name%"))
        );
    }

    public function getByActivityId($activityId)
    {
        return Organization::whereHas('activities', function($query) use ($activityId) {
            $query->where('activity_id', $activityId);
        })->get();
    }

    public function getByActivityName($activityName)
    {
        $activityIds = Activity::where('name', 'ilike', "%$activityName%")
            ->with('children.children')
            ->get()
            ->pluck('id')
            ->toArray();

        return $this->formatOrganization(
            Organization::whereHas('activities', function($query) use ($activityIds) {
                $query->whereIn('activities.id', $activityIds);
            })
        );
    }

}
