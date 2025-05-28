@extends('layouts.app')

@section('content')
<div class="container">
    @if(@session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">{{ __('Assign List') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Task</th>
                                    <th>Team Member</th>
                                    <th>Status</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($assigns instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $assigns->firstItem() : 1; @endphp
                                @foreach ($assigns as $assign)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $assign->task->name }}</td>
                                        <td>
                                            @if($assign->teamMember)
                                                {{ $assign->teamMember->user->name }}
                                            @else
                                                No member assigned
                                            @endif
                                        </td>
                                        <td>
                                            @if($assign->status == 'pending')
                                                <span class="badge bg-info">Pending</span>
                                            @elseif($assign->status == 'ongoing')
                                                <span class="badge bg-purple">Ongoing</span>
                                            @elseif($assign->status == 'completed')
                                                <span class="badge bg-success">Completed</span>
                                            @else
                                                <span class="badge bg-secondary">Unknown</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($assign['start_date'])->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($assign['end_date'])->format('d F Y') }}</td>
                                        <td>{{ $assign['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $assign->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/assigns/edit/$assign->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/assigns/delete/$assign->id") }}"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $assigns->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
