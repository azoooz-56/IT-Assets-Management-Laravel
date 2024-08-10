<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreITAssetRequest;
use App\Http\Requests\UpdateITAssetRequest;
use App\Models\ITAsset;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ITAssetController extends Controller
{
    public function index()
    {
        $assets = ITAsset::all();
        return response()->json($assets);
    }

    public function store(StoreITAssetRequest $request)
    {
        $validated = $request->validated();

        $asset = ITAsset::create($validated);

        return response()->json([
            'message' => 'Asset created successfully',
            'data' => $asset
        ], JsonResponse::HTTP_OK);
    }

    public function show(ITAsset $asset)
    {
        return response()->json($asset);
    }

    public function update(UpdateITAssetRequest $request, ITAsset $asset)
    {
        // Now you can use $asset directly without needing to find it manually
        // $asset is already resolved by Laravel

        $validated = $request->validated();

        // Update the asset
        $asset->update($validated);

        return response()->json([
            'message' => 'Asset updated successfully',
            'data' => $asset
        ], Response::HTTP_OK);
    }


    public function destroy(ITAsset $asset)
    {
        $asset->delete();

        return response()->json([
            'message' => 'Asset deleted successfully'
        ], Response::HTTP_OK);
    }
}

