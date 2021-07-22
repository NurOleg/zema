<?php


namespace App\Services\App;


use App\Http\Requests\App\City\ListCityRequest;
use App\Models\City;

final class CityService
{
    /**
     * @param ListCityRequest $request
     * @return array
     */
    public function index(ListCityRequest $request): array
    {
        $cities = City::where('name', 'like', '%' . $request->get('search') . '%')->get();

        return ['cities' => $cities];
    }
}
