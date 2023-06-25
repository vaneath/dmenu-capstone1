<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;
use App\Models\Review;
use App\Models\OrderItem;
use App\Http\Services\StatisticsService;
use Carbon\Carbon;

use App\Http\Controllers\Controller;

class StatisticsController extends Controller
{
    // General Information For A Restaurant Owner
    public function index(User $user)
    {
        $user_id = $user->id;
        $within = request('within'); // How many days back in time
        $within_type = request('within_type'); // minutes, hours, days, weeks, months, years

        // check user role
        if ($user->role == 'admin') {
            $statistics = StatisticsService::adminStatistics($user_id, $within, $within_type);
        } elseif ($user->role == 'superadmin') {
            $statistics = StatisticsService::superAdminStatistics($user_id, $within, $within_type);
        } else {
            $statistics = [];
        }

        $total_reviews = '';
        return response()->json([
            'statistics' => $statistics,
        ]);
    }
}
