<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Area;
use Illuminate\Http\JsonResponse;

class GetAreaAction extends Controller
{
    public function __invoke(string $ref): JsonResponse
    {
        $area = Area::with(['cities:area,ref,description'])->find($ref);
        return response()->json($area);
    }
}
