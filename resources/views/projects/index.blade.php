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
                <div class="card-header">{{ __('Project List') }}
                <a href="{{ url('/projects/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Client</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($projects instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $projects->firstItem() : 1; @endphp
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $project['name'] }}</td>
                                        <td>{{ $project['description'] }}</td>
                                        <td>{{ \Carbon\Carbon::parse($project['start_date'])->format('d F Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($project['end_date'])->format('d F Y') }}</td>
                                        <td>
                                            @if($project['status'] == 'ongoing')
                                                <span class="badge bg-success">{{ $project['status'] }}</span>
                                            @elseif($project['status'] == 'ended')
                                                <span class="badge bg-secondary">{{ $project['status'] }}</span>
                                            @else
                                                <span class="badge bg-info">{{ $project['status'] }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $project->user->name }}</td>
                                        <td>{{ $project->client->name }}</td>
                                        <td>{{ $project['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $project->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/projects/edit/$project->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/projects/delete/$project->id") }}"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
