<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\App\City\ListCityRequest;
use App\Services\App\CityService;
use Illuminate\Http\JsonResponse;

final class CityController extends BaseAppController
{
    /**
     * @var CityService
     */
    private CityService $cityService;

    /**
     * CityController constructor.
     * @param CityService $cityService
     */
    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
    }

    /**
     * @param ListCityRequest $request
     * @return JsonResponse
     */
    public function index(ListCityRequest $request): JsonResponse
    {
        $cities = $this->cityService->index($request);

        return $this->successResponse($cities);
    }
}
