@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-5 fw-bold">Meet Our Teams</h2>

    @foreach($teams as $team)
        <div class="mb-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h4 class="fw-semibold mb-1">{{ $team->name }}</h4>
                    @if($team->description)
                        <p class="text-muted mb-0">{{ $team->description }}</p>
                    @endif
                </div>

                {{-- Display Project(s) for this team --}}
                <div>
                    @if($team->project)
                        <span class="badge bg-purple">{{ $team->project->name }}</span>
                    @else
                        <span class="badge bg-secondary">No Project</span>
                    @endif
                </div>
            </div>

            <div class="row g-4">
                @php
                    $members = $teamMembers->where('team_id', $team->id);
                @endphp

                @forelse($members as $member)
                    <div class="col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm h-100 text-center p-3 team-member-card">
                            <div class="mb-3">
                                <img 
                                    src="{{ $member->user->profile ? asset('storage/' . $member->user->profile) : asset('default-avatar.png') }}" 
                                    alt="{{ $member->user->name }}" 
                                    class="rounded-circle" 
                                    style="width: 100px; height: 100px; object-fit: cover;"
                                >
                            </div>
                            <div>
                                <h5 class="fw-bold mb-1">{{ $member->user->name }}</h5>
                                <p class="text-muted small mb-1">{{ $member->role ?? 'Team Member' }}</p>
                                @if($member->user->email)
                                    <p class="text-muted small mb-0">{{ $member->user->email }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-muted">No members found in this team.</p>
                    </div>
                @endforelse
            </div>
        </div>
    @endforeach
</div>
@endsection
