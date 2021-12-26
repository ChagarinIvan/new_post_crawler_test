<?php

namespace App\Http\Controllers\Api;

use Illuminate\Routing\Controller;
use App\Models\Area;
use Illuminate\Http\JsonResponse;

class GetAreasListAction extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(Area::all('ref', 'description'));
    }
}
