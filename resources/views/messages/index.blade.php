@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header">
            {{ __('Message List') }}
            <a href="{{ url('/messages/add') }}" class="btn btn-primary float-end">Send Message</a>
        </div>
        <div class="card-body">
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Message</th>
                        <th>Sent At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = ($messages instanceof \Illuminate\Pagination\LengthAwarePaginator) ? $messages->firstItem() : 1; @endphp
                    @foreach($messages as $msg)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $msg->sender->name }}</td>
                            <td>{{ $msg->receiver->name }}</td>
                            <td>{{ $msg->message }}</td>
                            <td>{{ $msg->created_at->diffForHumans() }}</td>
                            <td>
                                <a href="{{ url("/messages/edit/$msg->id") }}" class="btn btn-warning mb-1"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="{{ url("/messages/delete/$msg->id") }}" class="btn btn-danger mb-1">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
