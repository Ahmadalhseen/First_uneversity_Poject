<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
class ManagerController extends Controller
{
    public function getUserStatistics() {
        $totalUsers = User::count();
        $activeUsers = User::where('can_add', 1)->count();
        $usersWithProperties = User::has('properties')->count();

        // User types for Pie Chart
        $userTypes = User::select('user_type', \DB::raw('count(*) as count'))
                        ->groupBy('user_type')
                        ->pluck('count', 'user_type');

        // Registrations over time for Line Chart
        $registrationsOverTime = User::select(\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as count'))
                                    ->groupBy('date')
                                    ->orderBy('date', 'asc')
                                    ->get();

        return response()->json([
            'totalUsers' => $totalUsers,
            'activeUsers' => $activeUsers,
            'usersWithProperties' => $usersWithProperties,
            'userTypes' => $userTypes,
            'registrationsOverTime' => $registrationsOverTime,
        ]);
    }
}
