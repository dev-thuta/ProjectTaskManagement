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
                <div class="card-header">{{ __('User List') }}
                <a href="{{ url('/users/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Profile</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Phone</th>
                                    <th>State</th>
                                    <th>Town</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($users instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $users->firstItem() : 1; @endphp
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $user['name'] }}</td>
                                        <td><img src="{{ asset('storage/' . $user->profile) }}" alt="{{ $user->name }}" style="max-width:100px;
                                        max-height:100px;"></td>
                                        <td>{{ $user['email'] }}</td>
                                        <td>{{ $user->role->name }}</td>
                                        <td>{{ $user['phone'] }}</td>
                                        <td>{{ $user->state->name }}</td>
                                        <td>{{ $user->town->name }}</td>
                                        <td>{{ $user['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/users/edit/$user->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/users/delete/$user->id") }}"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
