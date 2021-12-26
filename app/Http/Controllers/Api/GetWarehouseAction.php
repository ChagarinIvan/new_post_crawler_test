<?php

namespace App\Http\Controllers\Api;

use App\Models\Warehouse;
use Illuminate\Routing\Controller;
use Illuminate\Http\JsonResponse;

class GetWarehouseAction extends Controller
{
    public function __invoke(string $ref): JsonResponse
    {
        $warehouse = Warehouse::with(['type'])->find($ref);
        return response()->json($warehouse);
    }
}
