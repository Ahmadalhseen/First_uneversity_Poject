<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function getPrice(Request $request)
    {
        $response = Http::post('http://127.0.0.1:5000/predict', [
            'area' => $request->input('area'),
            'bedrooms' => $request->input('bedrooms'),
            'bathrooms' => $request->input('bathrooms'),
            'view' => $request->input('view'),
            'condition' => $request->input('condition'),
            'grade' => $request->input('grade'),
            'location' => $request->input('location'),
            'direction' => $request->input('direction')
        ]);

        $predictedPrice = $response->json('predicted_price');

        return response()->json(['price' => $predictedPrice]);
    }
}
