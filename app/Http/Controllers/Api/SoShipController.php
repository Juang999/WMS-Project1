<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SoShipMaster;
use App\SoShipDDetail;

class SoShipController extends Controller
{
    public function index()
    {
        try {
            $data = SoShipMaster::with('SoShipDDetail')->paginate(100);

            return response()->json([
                'message' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'failed to get data',
                'error' => $th->getMessage()
            ], 401);
        }
    }

    public function show($soship_code)
    {
        try {
            $data = SoShipMaster::where('soship_code', $soship_code)->with('SoShipDDetail')->first();

            return response()->json([
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'error to get data',
                'error' => $th->getMessage()
            ], 401);
        }
    }
}
