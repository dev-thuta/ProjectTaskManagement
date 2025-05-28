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
                <div class="card-header">{{ __('Team List') }}
                <a href="{{ url('/teams/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Project</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($teams instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $teams->firstItem() : 1; @endphp
                                @foreach ($teams as $team)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $team['name'] }}</td>
                                        <td>{{ $team->project->name }}</td>
                                        <td>{{ $team['description'] }}</td>
                                        <td>{{ $team['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $team->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/teams/edit/$team->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/teams/delete/$team->id") }}" onclick="return confirm('Are you sure you want to delete this team?');"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $teams->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
