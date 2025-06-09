@extends('layouts.user')

@section('content')
    <div class="container py-5">
        @if(@session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="text-center mb-4">
                    <img src="{{ $user->profile ? asset('storage/' . $user->profile) : asset('default-avatar.png') }}" 
                                alt="{{ $user->name }}" 
                        class="rounded-circle img-fluid" style="width: 180px; height: 180px; object-fit: cover;">
                    <h1 class="te-cl mt-3">{{ $user->name }} 
                    <a href="{{ url("/front/users/edit-profile/$user->id") }}" class="btn btn-light"><i class="fa-solid fa-pen-to-square"></i></a></h1>
                    <p class="te-cl">{{ $user->role->name }}</p>
                </div>

                <hr>

                <div class="list-group">
                    <div class="list-group-item d-flex align-items-center">
                        <div class="me-3 fs-4 text-secondary">
                            <i class="ri-phone-line"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Phone Number</small>
                            <span>{{ $user->phone ?? 'N/A' }}</span>
                        </div>
                    </div>

                    <div class="list-group-item d-flex align-items-center">
                        <div class="me-3 fs-4 text-secondary">
                            <i class="ri-mail-line"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Email Address</small>
                            <span>{{ $user->email }}</span>
                        </div>
                    </div>

                    <div class="list-group-item d-flex align-items-center">
                        <div class="me-3 fs-4 text-secondary">
                            <i class="ri-home-line"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">State</small>
                            <span>{{ $user->state->name }}</span>
                        </div>
                    </div>

                    <div class="list-group-item d-flex align-items-center">
                        <div class="me-3 fs-4 text-secondary">
                            <i class="ri-building-line"></i>
                        </div>
                        <div>
                            <small class="text-muted d-block">Town</small>
                            <span>{{ $user->town->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="card mt-4 p-3 rounded d-flex justify-content-between align-items-center shadow-sm">
                    <div>
                        <h5 class="mb-1">Profile Status</h5>
                        <small class="text-muted">Your profile information is up to date</small>
                    </div>
                    <div class="fs-4 text-secondary">
                        <i class="ri-shield-check-line"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
