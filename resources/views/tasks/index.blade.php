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
                <div class="card-header">{{ __('Task List') }}
                <a href="{{ url('/tasks/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Assign To</th>
                                    <th>Assigned Members</th>
                                    <th>Description</th>
                                    <th>Priority</th>
                                    <th>Project</th>
                                    <th>Team</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($tasks instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $tasks->firstItem() : 1; @endphp
                                @foreach ($tasks as $task)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $task['name'] }}</td>
                                        <td>
                                            <a href="{{ url("/assigns/add/$task->id") }}" class="btn btn-primary mb-1"><i class="fa-solid fa-plus"></i></a>
                                        </td>
                                        <td>
                                            @if($task->teamMembers->count() > 0)
                                                <ul class="list-unstyled mb-0">
                                                    @foreach($task->teamMembers as $member)
                                                        <li><span class="badge bg-purple">{{ $member->user->name }}</span></li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <span class="badge bg-secondary">No members assigned</span>
                                            @endif
                                        </td>
                                        <td>{{ $task['description'] }}</td>
                                        <td>
                                            @if($task['priority'] == 'high')
                                                <span class="badge bg-danger">{{ $task['priority'] }}</span>
                                            @elseif($task['priority'] == 'medium')
                                                <span class="badge bg-warning">{{ $task['priority'] }}</span>
                                            @else
                                                <span class="badge bg-success">{{ $task['priority'] }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $task->project->name }}</td>
                                        <td>{{ $task->team->name }}</td>
                                        <td>{{ $task['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $task->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/tasks/edit/$task->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/tasks/delete/$task->id") }}"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
