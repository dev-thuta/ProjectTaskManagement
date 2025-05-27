@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Client') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/clients/update/' . $client->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- name field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $client->name) }}" autocomplete="name" autofocus>

                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- email field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $client->email) }}" autocomplete="email">

                                <label for="email" class="form-label">{{ __('Email Address') }}</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- phone field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ old('phone', $client->phone) }}" autocomplete="phone">

                                <label for="phone" class="form-label">{{ __('Phone') }}</label>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- profile field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input class="form-control" type="file" name="profile" id="profile">

                                <label for="profile" class="form-label">{{ __('Profile') }}</label>
                            </div>
                        </div>
                        
                        {{-- Show current profile image --}}
                        <div class="row mb-3 align-items-center">
                            @if($client->profile)
                            <div class="col-auto">
                                <label class="form-label d-block mb-2">{{ __('Current Profile Image') }}</label>
                                <img src="{{ asset('storage/' . $client->profile) }}" alt="{{ $client->name }}" class="img-thumbnail" style="max-width: 150px;">
                            </div>
                            @endif
                            <div class="col">
                                <div class="d-flex justify-content-end gap-2 mb-5">
                                    <a href="{{ url('/clients') }}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection