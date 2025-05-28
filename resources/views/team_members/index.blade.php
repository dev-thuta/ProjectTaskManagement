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
                <div class="card-header">{{ __('Team Member List') }}
                <a href="{{ url('/team-members/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Team</th>
                                    <th>Member</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($teammembers instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $teammembers->firstItem() : 1; @endphp
                                @foreach ($teammembers as $teammember)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $teammember->team->name }}</td>
                                        <td>{{ $teammember->user->name }}</td>
                                        <td>{{ $teammember['role'] }}</td>
                                        <td>{{ $teammember['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $teammember->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/team-members/edit/$teammember->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/team-members/delete/$teammember->id") }}" onclick="return confirm('Are you sure you want to delete this team member?');"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $teammembers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
