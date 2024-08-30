<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\Property_Location;
use DB;
class PropertyStatisticsController extends Controller
{
    public function getPropertyStatistics()
    {
        // Total number of properties
        $totalProperties = Property::count();

        // Number of properties by condition
        $propertiesByCondition = Property::select('condition', DB::raw('count(*) as count'))
                                    ->groupBy('condition')
                                    ->pluck('count', 'condition');

        // Average sale price of properties
        $averagePrice = Property::avg('sale_price');

        // Number of properties by location
        $propertiesByLocation = Property::select('location', DB::raw('count(*) as count'))
                                        ->groupBy('location')
                                        ->pluck('count', 'location');

        // Number of properties by grade
        $propertiesByGrade = Property::select('grade', DB::raw('count(*) as count'))
                                     ->groupBy('grade')
                                     ->pluck('count', 'grade');

        // Number of properties by number of bedrooms
        $propertiesByBedroom = Property::select('bedroom', DB::raw('count(*) as count'))
                                       ->groupBy('bedroom')
                                       ->pluck('count', 'bedroom');

        return response()->json([
            'totalProperties' => $totalProperties,
            'propertiesByCondition' => $propertiesByCondition,
            'averagePrice' => $averagePrice,
            'propertiesByLocation' => $propertiesByLocation,
            'propertiesByGrade' => $propertiesByGrade,
            'propertiesByBedroom' => $propertiesByBedroom,
        ]);
    }
}

