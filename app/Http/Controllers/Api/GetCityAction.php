<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class GetCityAction extends Controller
{
    public function __invoke(string $ref): JsonResponse
    {
        $city = City::with(['warehouses:city_ref,ref,description'])->find($ref);
        return response()->json($city);
    }
}
