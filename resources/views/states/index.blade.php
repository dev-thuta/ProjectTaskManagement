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
                <div class="card-header">{{ __('State List') }}
                <a href="{{ url('/states/add')}}" class="btn btn-primary float-end">Add</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover rounded">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = ($states instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $states->firstItem() : 1; @endphp
                                @foreach ($states as $state)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $state['name'] }}</td>
                                        <td>{{ $state['created_at']->format('Y-m-d') }}</td>
                                        <td>{{ $state->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ url("/states/edit/$state->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <a class="btn btn-danger mb-1" href="{{ url("/states/delete/$state->id") }}" onclick="return confirm('Are you sure you want to delete this state?');"><i class="fa-solid fa-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center align-items-center">
                    {{ $states->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
