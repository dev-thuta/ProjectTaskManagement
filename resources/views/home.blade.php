@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0 rounded-4" style="opacity: 0.9">
                <div class="card-header bg-white border-0">
                    <h4 class="mb-0 fw-semibold"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success mb-4" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm rounded-4 py-4">
                                <h5 class="text-muted"><i class="fas fa-folder-open me-2"></i>Projects</h5>
                                <h3 class="text-primary fw-bold">
                                    @if(isset($totalProjects) && $totalProjects > 0)
                                        {{ $totalProjects }}
                                    @else
                                        No data
                                    @endif
                                </h3>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm rounded-4 py-4">
                                <h5 class="text-muted"><i class="fas fa-calendar-alt me-2"></i>This Month</h5>
                                <h3 class="text-purple fw-bold">
                                    @if(isset($projectsThisMonth) && $projectsThisMonth > 0)
                                        {{ $projectsThisMonth }}
                                    @else
                                        No data
                                    @endif
                                </h3>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm rounded-4 py-4">
                                <h5 class="text-muted"><i class="fas fa-spinner me-2"></i>Ongoing</h5>
                                <h3 class="text-success fw-bold">
                                    @if(isset($ongoingProjects) && $ongoingProjects > 0)
                                        {{ $ongoingProjects }}
                                    @else
                                        No data
                                    @endif
                                </h3>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm rounded-4 py-4">
                                <h5 class="text-muted"><i class="fas fa-clock me-2"></i>Pending</h5>
                                <h3 class="text-info fw-bold">
                                    @if(isset($pendingProjects) && $pendingProjects > 0)
                                        {{ $pendingProjects }}
                                    @else
                                        No data
                                    @endif
                                </h3>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="card border-0 shadow-sm rounded-4 py-4">
                                <h5 class="text-muted"><i class="fas fa-users me-2"></i>Clients</h5>
                                <h3 class="text-dark fw-bold">
                                    @if(isset($totalClients) && $totalClients > 0)
                                        {{ $totalClients }}
                                    @else
                                        No data
                                    @endif
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a href="{{ url('/projects') }}" class="btn btn-primary"><i class="fas fa-tasks me-1"></i>Manage Projects</a>
                    </div>
                </div>
            </div>

            <div class="row mt-4" style="opacity: 0.9">
                <div class="col-md-8">
                    <h5 class="fw-semibold mb-3"><i class="fas fa-file-alt me-2"></i>Latest Projects</h5>
                    <ul class="list-group shadow-sm">
                        @forelse($latestProjects as $project)
                            <li class="list-group-item">
                                {{ $project->name }} <small class="text-muted d-block">{{ $project->created_at->diffForHumans() }}</small>
                            </li>
                        @empty
                            <li class="list-group-item text-muted">No recent projects</li>
                        @endforelse
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="fw-semibold mb-2"><i class="fas fa-user-circle me-2"></i>Logged in as</h5>
                    <div class="card shadow-sm border-0 rounded-4 p-3">
                        <p class="mb-0"><strong>Name:</strong> {{ $user->name }}</p>
                        <p class="mb-0"><strong>Email:</strong> {{ $user->email }}</p>
                        <p class="mb-0"><strong>Projects Managed:</strong> <span class="badge bg-purple">{{ $user->projects()->count() ?? 0 }}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
