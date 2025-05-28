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
                <div class="card-header">{{ __('Role List') }}
                <a href="{{ url('/roles/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($roles instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $roles->firstItem() : 1; @endphp
                                @foreach ($roles as $role)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $role['name'] }}</td>
                                        <td>{{ $role['description'] }}</td>
                                        <td>{{ $role['created_at'] ? $role['created_at']->format('Y-m-d') : 'N/A' }}</td>
                                        <td>{{ $role['updated_at'] ? $role['updated_at']->diffForHumans() : 'N/A' }}</td>
                                        <td>
                                            <a href="{{ url("/roles/edit/$role->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/roles/delete/$role->id") }}" onclick="return confirm('Are you sure you want to delete this role?');"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
