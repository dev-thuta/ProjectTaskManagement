@extends('layouts.user')

@section('content')
<div class="container py-4">
    <!-- Filter Bar -->
    <nav class="filter-bar mb-4 d-flex gap-2 flex-wrap">
        <button class="filter-button active px-3 py-1 rounded" data-filter="all">All Tasks</button>
        <button class="filter-button px-3 py-1 rounded" data-filter="completed">Completed</button>
        <button class="filter-button px-3 py-1 rounded" data-filter="ongoing">In Progress</button>
        <button class="filter-button px-3 py-1 rounded" data-filter="pending">Pending</button>
    </nav>

    <h3 class="mb-4">Your Assigned Tasks</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
        @php
            $statusColors = [
                'completed' => 'success',
                'ongoing' => 'purple',
                'pending' => 'info',
            ];
        @endphp

        @forelse($assigns as $assign)
            @php $task = $assign->task; @endphp
            <div class="col">
                <div class="card task-card shadow-sm h-100 border-0 rounded-3"
                     style="transition: transform 0.2s ease-in-out;"
                     onmouseover="this.style.transform='translateY(-5px)';"
                     onmouseout="this.style.transform='translateY(0)';"
                     data-status="{{ $assign->status ?? 'unknown' }}">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center rounded-top">
                        <h5 class="card-title mb-0">{{ $task->name }}</h5>
                        @php
                            $badgeClass = $statusColors[$assign->status] ?? 'secondary';
                        @endphp
                        <button type="button"
                                class="badge bg-{{ $badgeClass }} text-uppercase small border-0"
                                data-bs-toggle="modal"
                                data-bs-target="#statusModal-{{ $assign->id }}">
                            {{ $assign->status }}
                        </button>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">{{ $task->description }}</p>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="bi bi-people-fill me-2 text-primary"></i>
                                <strong>Team:</strong> {{ $task->team->name ?? 'N/A' }}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-calendar-event-fill me-2 text-success"></i>
                                @if($assign->end_date)
                                    @php
                                        $daysLeft = now()->diffInDays($assign->end_date, false);
                                    @endphp
                                    @if($daysLeft > 0)
                                        Ends in: {{ $daysLeft }} day{{ $daysLeft > 1 ? 's' : '' }}
                                    @elseif($daysLeft === 0)
                                        Ends today
                                    @else
                                        Ended {{ abs($daysLeft) }} day{{ abs($daysLeft) > 1 ? 's' : '' }} ago
                                    @endif
                                @else
                                    No end date
                                @endif
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-exclamation-circle-fill me-2 text-danger"></i>
                                <strong>Priority:</strong>
                                @if ($task->priority === 'high')
                                    <span class="badge bg-danger">High</span>
                                @elseif ($task->priority === 'medium')
                                    <span class="badge bg-warning">Medium</span>
                                @else
                                    <span class="badge bg-success">Low</span>
                                @endif
                            </li>
                            <li class="mb-2">
    <i class="bi bi-tag-fill me-2 text-info"></i>
    <strong>Type:</strong> {{ ucfirst($task->type ?? 'N/A') }}
</li>

                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <p>No assigned tasks found for you.</p>
        @endforelse
    </div>
    <p class="no-tasks-message text-center text-muted my-3 d-none">No tasks found for the selected filter.</p>


    <h3 class="mb-4">Tasks Where You're Part of the Team</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @forelse($tasks as $task)
            @php
                $userAssign = $task->assignTos->first();
                $badgeClass = $statusColors[$userAssign->status ?? ''] ?? 'secondary';
            @endphp
            <div class="col">
                <div class="card task-card shadow-sm h-100 border-0 rounded-3"
                     style="transition: transform 0.2s ease-in-out;"
                     onmouseover="this.style.transform='translateY(-5px)';"
                     onmouseout="this.style.transform='translateY(0)';"
                     data-status="{{ $userAssign->status ?? 'unknown' }}">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center rounded-top">
                        <h5 class="card-title mb-0">{{ $task->name }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">{{ $task->description }}</p>
                        <ul class="list-unstyled mb-3">
                            <li class="mb-2">
                                <i class="bi bi-people-fill me-2 text-primary"></i>
                                <strong>Team:</strong> {{ $task->team->name ?? 'N/A' }}
                            </li>
                            <li class="mb-2">
                                <i class="bi bi-calendar-event-fill me-2 text-success"></i>
                                @if($task->end_date ?? null)
                                    @php
                                        $daysLeft = now()->diffInDays($task->end_date, false);
                                    @endphp
                                    @if($daysLeft > 0)
                                        Ends in: {{ $daysLeft }} day{{ $daysLeft > 1 ? 's' : '' }}
                                    @elseif($daysLeft === 0)
                                        Ends today
                                    @else
                                        Ended {{ abs($daysLeft) }} day{{ abs($daysLeft) > 1 ? 's' : '' }} ago
                                    @endif
                                @else
                                    No end date
                                @endif
                            </li>
                        </ul>

                        <p><strong>Assigned Users:</strong></p>
                        <ul class="list-unstyled">
                            @forelse($task->assignTos as $assign)
                                @php
                                    $user = $assign->teamMember->user;
                                    $avatar = $user->profile ? asset('storage/' . $user->profile) : asset('default-avatar.png');
                                @endphp
                                <li class="d-flex align-items-center mb-2">
                                    <img src="{{ $avatar }}" 
                                        alt="{{ $user->name }}" 
                                        class="rounded-circle me-2" 
                                        style="width: 32px; height: 32px; object-fit: cover;">
                                    <span>
                                        {{ $user->name }}
                                        @if($user->id === auth()->id())
                                            <span class="text-muted fw-semibold ms-1">(You)</span>
                                        @endif
                                    </span>
                                </li>
                            @empty
                                <li>No users assigned</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <p>No tasks found where you are part of the team.</p>
        @endforelse
    </div>
    <p class="no-tasks-message text-center text-muted my-3 d-none">No tasks found for the selected filter.</p>
    @foreach($assigns as $assign)
    <div class="modal fade" id="statusModal-{{ $assign->id }}" tabindex="-1" aria-labelledby="statusModalLabel-{{ $assign->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ url('/front/users/task/update/' . $assign->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel-{{ $assign->id }}">Update Task Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $assign->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="ongoing" {{ $assign->status === 'ongoing' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ $assign->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-button");

    filterButtons.forEach(button => {
        button.addEventListener("click", () => {
            const filter = button.getAttribute("data-filter");

            // Toggle active class on filter buttons
            filterButtons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");

            // Filter all task rows separately
            document.querySelectorAll(".row").forEach(row => {
                const cols = row.querySelectorAll(".col");
                let visibleCount = 0;

                cols.forEach(col => {
                    const card = col.querySelector(".task-card");
                    const status = card?.getAttribute("data-status");

                    if (filter === "all" || status === filter) {
                        col.classList.remove("d-none");
                        visibleCount++;
                    } else {
                        col.classList.add("d-none");
                    }
                });

                // Show/hide the no-tasks message immediately after the row
                const noTasksMsg = row.nextElementSibling;
                if (noTasksMsg && noTasksMsg.classList.contains("no-tasks-message")) {
                    if (visibleCount === 0) {
                        noTasksMsg.classList.remove("d-none");
                    } else {
                        noTasksMsg.classList.add("d-none");
                    }
                }
            });
        });
    });
});

</script>
@endpush
