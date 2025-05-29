@extends('layouts.user')

@section('content')
    <div class="container">
        <div class="header">
            <h1>Welcome to the Project Dashboard, {{ auth()->check() ? auth()->user()->name : 'Guest' }}!</h1>
            <p>Monitor your teams, timelines, and tasks all in one place — updated in real-time.</p>
        </div>

        <!-- Enhanced Table Card -->
        <div class="table-card">
            <div class="table-header">
                <h2>
                    <i class="fas fa-scroll"></i>
                    Projects Overview
                </h2>
            </div>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Team</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $project)
                            <tr>
                                <td>{{ $project->name }}</td>
                                <td>
                                    @if ($project->team->isNotEmpty())
                                        {{ $project->team->pluck('name')->join(', ') }}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($project->start_date)->format('M d, Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($project->end_date)->format('M d, Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Upcoming Tasks Section -->
        @if ($upcomingTasks->isNotEmpty())
            <div class="mt-5">
                <div class="table-header">
                    <h2>
                        <i class="fas fa-hourglass-half"></i>
                        Upcoming Tasks
                    </h2>
                </div>
                <ul class="list-group mt-3">
                    @foreach ($upcomingTasks as $task)
                        @php
                            $upcomingAssign = $task->assignTos->firstWhere('end_date', '>', now());
                        @endphp
                        @if ($upcomingAssign)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>{{ $task->name }}</strong> (Team: {{ $task->team->name ?? 'N/A' }})<br>
                                    <small class="text-muted">Ends on {{ $upcomingAssign->end_date->format('M d, Y') }}</small>
                                </div>
                                <span class="badge bg-danger">
                                    {{ $upcomingAssign->end_date->diffForHumans(null, false, false, 2) }}
                                </span>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
