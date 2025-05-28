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
                <div class="card-header">{{ __('Client List') }}
                <a href="{{ url('/clients/add')}}" class="btn btn-primary float-end">Add</a>
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
                                    <th>Phone</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($clients instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $clients->firstItem() : 1; @endphp
                                @foreach ($clients as $client)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $client['name'] }}</td>
                                        <td><img src="{{ asset('storage/' . $client->profile) }}" alt="{{ $client->name }}" style="max-width:100px;
                                        max-height:100px;"></td>
                                        <td>{{ $client['email'] }}</td>
                                        <td>{{ $client['phone'] }}</td>
                                        <td>{{ $client->user->name }}</td>
                                        <td>{{ $client['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $client->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/clients/edit/$client->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/clients/delete/$client->id") }}" onclick="return confirm('Are you sure you want to delete this client?');"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
