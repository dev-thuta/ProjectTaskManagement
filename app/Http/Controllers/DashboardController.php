<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $userId = auth()->id();

        return view('home', [
            'totalClients' => Client::where('created_by', $userId)->count(),

            'totalProjects' => Project::where('created_by', $userId)->count(),
            'ongoingProjects' => Project::where('created_by', $userId)
                                        ->where('status', 'ongoing')
                                        ->count(),
            'pendingProjects' => Project::where('created_by', $userId)
                                        ->where('status', 'pending')
                                        ->count(),
            'projectsThisMonth' => Project::where('created_by', $userId)
                                        ->whereMonth('created_at', $now->month)
                                        ->count(),
            'latestProjects' => Project::where('created_by', $userId)
                                    ->latest()
                                    ->take(3)
                                    ->get(),
            'user' => Auth::user(),
        ]);

    }
}
