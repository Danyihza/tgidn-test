<?php

namespace App\Http\Controllers\Api\Vehicle;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class GetAllController extends Controller
{
    public function __invoke(Request $request)
    {
        $q = $request->search;
        $type = strtolower($request->type);
        $dateFrom = Carbon::createFromDate($request->from)->startOfDay();
        $dateTo = $request->to
            ? Carbon::createFromDate($request->to)->endOfDay()
            : Carbon::createFromDate($request->from)->endOfDay();
        $page = $request->page;

        $query = DB::table("view_vehicles");

        if ($type) $query->where('type_name', 'LIKE', "%$type%");

        if ($q) $query->where('name', 'LIKE', "%$q%");

        if ($dateFrom) $query->whereBetween('created_at', [$dateFrom, $dateTo]);

        if ($page) {
            $query->skip(($page - 1) * 10);
            $query->take(10);
        }

        $query->latest();

        $result = $query->get();

        if (count($result) < 1) return response()->json([
            'success' => false,
            'message' => 'Not Found'
        ], 404);

        return response()->json([
            'success' => true,
            'message' => 'Success',
            'data' => $result
        ]);
    }
}
