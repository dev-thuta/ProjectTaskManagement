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

        return view('home', [
            'totalClients' => Client::count(),
            'totalProjects' => Project::count(),
            'ongoingProjects' => Project::where('status', 'ongoing')->count(),
            'pendingProjects' => Project::where('status', 'pending')->count(),
            'projectsThisMonth' => Project::whereMonth('created_at', $now->month)->count(),
            'latestProjects' => Project::latest()->take(3)->get(),
            'user' => Auth::user(),
        ]);
    }
}
