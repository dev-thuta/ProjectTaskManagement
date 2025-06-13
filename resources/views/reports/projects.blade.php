@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4">📊 Project Report</h2>

    <!-- Filter Form -->
    <form method="GET" class="row mb-4 g-3">
    <div class="col-md-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $startDate ?? '') }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $endDate ?? '') }}" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="status" class="form-label">Project Status</label>
        <select name="status" id="status" class="form-select">
            <option value="">-- All --</option>
            <option value="ongoing" {{ (old('status', $status ?? '') == 'ongoing') ? 'selected' : '' }}>Ongoing</option>
            <option value="pending" {{ (old('status', $status ?? '') == 'pending') ? 'selected' : '' }}>Pending</option>
            <option value="completed" {{ (old('status', $status ?? '') == 'completed') ? 'selected' : '' }}>Completed</option>
        </select>
    </div>
    <div class="col-md-3 align-self-end">
        <button type="submit" class="btn btn-primary w-100">Generate Report</button>
    </div>
</form>


    <!-- Summary Cards -->
    <div class="row text-center mb-4">
        <div class="col">
            <div class="card p-3 shadow-sm">
                <h6>Total</h6>
                <strong>{{ $report['total'] }}</strong>
            </div>
        </div>
        <div class="col">
            <div class="card p-3 shadow-sm">
                <h6>Ongoing</h6>
                <strong>{{ $report['ongoing'] }}</strong>
            </div>
        </div>
        <div class="col">
            <div class="card p-3 shadow-sm">
                <h6>Pending</h6>
                <strong>{{ $report['pending'] }}</strong>
            </div>
        </div>
        <div class="col">
            <div class="card p-3 shadow-sm">
                <h6>Completed</h6>
                <strong>{{ $report['completed'] }}</strong>
            </div>
        </div>
    </div>

    <!-- Project Table -->
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Project Name</th>
                    <th>Status</th>
                    <th>Client Name</th>
                    <th>Client Email</th>
                    <th>Client Phone</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $project->name }}</td>
                        <td><span class="badge bg-secondary">{{ ucfirst($project->status) }}</span></td>
                        <td>{{ $project->client->name ?? 'N/A' }}</td>
                        <td>{{ $project->client->email ?? 'N/A' }}</td>
                        <td>{{ $project->client->phone ?? 'N/A' }}</td>
                        <td>{{ $project->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No projects found for the selected criteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Client Summary -->
    <div class="card mt-5">
        <div class="card-body">
            <h5 class="mb-3">🧾 Client Summary</h5>
            <ul class="list-group list-group-flush">
                @forelse($projects->groupBy('client_id') as $clientId => $clientProjects)
                    <li class="list-group-item">
                        {{ $clientProjects->first()->client->name ?? 'Unknown Client' }}:
                        <strong>{{ $clientProjects->count() }}</strong> project(s)
                    </li>
                @empty
                    <li class="list-group-item text-muted">No client data available.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>
@endsection
