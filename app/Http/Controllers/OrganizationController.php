<?php

namespace App\Http\Controllers;

use App\Services\OrganizationService;
use Illuminate\Routing\Controller;

/**
 * @OA\Info(
 *     title="Nebus API Test task",
 *     version="1.0.0",
 *     description="API для работы с организациями"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     name="X-API-Key",
 *     securityScheme="ApiKeyAuth"
 * )
 */
class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

   /**
     * @OA\Get(
     *     path="/api/v1/buildings/{buildingId}/organizations",
     *     summary="Список всех организаций находящихся в конкретном здании",
     *     security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(
     *         name="buildingId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций в здании"
     *     )
     * )
     */
    public function getOrganizationsByBuilding($buildingId)
    {
        return response()->json($this->organizationService->getOrganizationsByBuilding($buildingId));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/{id}",
     *     summary="Вывод информации об организации по её идентификатору",
     *     security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Сведения об организации"
     *     )
     * )
     */
    public function getOrganizationById($id)
    {
        return response()->json($this->organizationService->getOrganizationById($id));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/search/name/{name}",
     *     summary="Поиск организации по названию",
     *     security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список найденных организаций"
     *     )
     * )
     */
    public function getOrganizationsByName($name)
    {
        return response()->json($this->organizationService->getOrganizationsByName($name));
    }


  /**
     * @OA\Get(
     *     path="/api/v1/organizations/search/activity/id/{activityId}",
     *     summary="Поиск организаций по ID деятельности",
     *     security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(
     *         name="activityId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций с указанной деятельностью"
     *     )
     * )
     */
    public function getOrganizationsByActivityId($activityId)
    {
        return response()->json($this->organizationService->getOrganizationsByActivityId($activityId));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/search/activity/name/{activityName}",
     *     summary="Искать организации по виду деятельности. Например, поиск по виду деятельности «Еда»",
     *     security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(
     *         name="activityName",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций с указанным названием деятельности"
     *     )
     * )
     */
    public function getOrganizationsByActivityName($activityName)
    {
        return response()->json($this->organizationService->getOrganizationsByActivityName($activityName));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/area/rectangle/{minLat}/{maxLat}/{minLng}/{maxLng}",
     *     summary="Список организаций, которые находятся в заданной прямоугольной области относительно указанной точки на карте. список зданий",
     *     security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(
     *         name="minLat",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="maxLat",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="minLng",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="maxLng",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций в прямоугольной области"
     *     )
     * )
     */
    public function getOrganizationsInRectangle($minLat, $maxLat, $minLng, $maxLng)
    {
        return response()->json($this->organizationService->getOrganizationsInRectangle($minLat, $maxLat, $minLng, $maxLng));
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/area/radius/{latitude}/{longitude}/{radius}",
     *     summary="Список организаций, которые находятся в заданном радиусе относительно указанной точки на карте. список зданий",
     *     security={{"ApiKeyAuth": {}}},
     *     @OA\Parameter(
     *         name="latitude",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="longitude",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="number", format="float")
     *     ),
     *     @OA\Parameter(
     *         name="radius",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список организаций в радиусе"
     *     )
     * )
     */
    public function getOrganizationsInRadius($latitude, $longitude, $radius)
    {
        return response()->json($this->organizationService->getOrganizationsInRadius($latitude, $longitude, $radius));
    }
}
