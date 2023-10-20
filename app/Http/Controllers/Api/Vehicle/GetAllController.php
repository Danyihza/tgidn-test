<?php

namespace App\Http\Controllers\Api\Vehicle;

use App\Http\Controllers\Controller;
use App\Services\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GetAllController extends Controller
{
    public function __invoke(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'from' => 'date',
            'to' => 'date',
            'page' => 'numeric'
        ]);

        if ($validator->fails()) {
            return Response::badRequestError(message: $validator->errors());
        }

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

        if (count($result) < 1) return Response::notFoundError();

        return Response::success(data: $result);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Success',
        //     'data' => $result
        // ]);
    }
}
