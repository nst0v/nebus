<?php

namespace App\Services;

use App\Repositories\OrganizationRepository;

class OrganizationService
{
    protected $organizationRepository;

    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organizationRepository = $organizationRepository;
    }

    public function getOrganizationsByBuilding($buildingId)
    {
        return $this->organizationRepository->getByBuildingId($buildingId);
    }

    public function getOrganizationsInRadius($latitude, $longitude, $radius)
    {
        return $this->organizationRepository->getOrganizationsInRadius($latitude, $longitude, $radius);
    }

    public function getOrganizationById($id)
    {
        return $this->organizationRepository->getOrgById($id);
    }

    public function getOrganizationsByName($name)
    {
        return $this->organizationRepository->getOrgByName($name);
    }

    public function getOrganizationsByActivityId($activityId)
    {
        return $this->organizationRepository->getByActivityId($activityId);
    }

    public function getOrganizationsByActivityName($activityName)
    {
        return $this->organizationRepository->getByActivityName($activityName);
    }

    public function getOrganizationsInRectangle($minLat, $maxLat, $minLng, $maxLng)
    {
        return $this->organizationRepository->getOrganizationsInRectangle($minLat, $maxLat, $minLng, $maxLng);
    }
}
