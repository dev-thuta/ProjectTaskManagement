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

    public function report(Request $request)
{
    $userId = auth()->id();

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $status = $request->input('status');

    $query = Project::with('client')->where('created_by', $userId);

    if ($startDate && $endDate) {
        $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    if ($status && in_array($status, ['pending', 'ongoing', 'completed'])) {
        $query->where('status', $status);
    }

    $projects = $query->get();

    $report = [
        'total'     => $projects->count(),
        'completed' => $projects->where('status', 'completed')->count(),
        'ongoing'   => $projects->where('status', 'ongoing')->count(),
        'pending'   => $projects->where('status', 'pending')->count(),
    ];

    return view('reports.projects', [
        'projects' => $projects,
        'report' => $report,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'status' => $status,
    ]);
}



}
