@extends('layouts.user')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update User') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/users/update/' . $user->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- name field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" autocomplete="name" autofocus>

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" autocomplete="email">

                                <label for="email" class="form-label">{{ __('Email Address') }}</label>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Password field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                <label for="password" class="form-label">{{ __('Password') }} (leave blank to keep unchanged)</label>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- role field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('role_id') is-invalid @enderror" name="role_id" id="role_id">
                                    <option value="" disabled {{ old('role_id', $user->role_id) ? '' : 'selected' }}>Select Role</option>
                                    @foreach($roles as $role)
                                    <option value="{{ $role['id'] }}" {{ old('role_id', $user->role_id) == $role['id'] ? 'selected' : '' }}>
                                    {{ $role['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                                <label for="role_id" class="form-label">{{ __('Role') }}</label>

                                @error('role_id')
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
                                value="{{ old('phone', $user->phone) }}" autocomplete="phone">

                                <label for="phone" class="form-label">{{ __('Phone') }}</label>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- State field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('state_id') is-invalid @enderror" name="state_id" id="state_id">
                                    <option value="" disabled {{ old('state_id', $user->state_id) ? '' : 'selected' }}>Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{ $state['id'] }}" {{ old('state_id', $user->state_id) == $state['id'] ? 'selected' : '' }}>
                                    {{ $state['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                                <label for="state_id" class="form-label">{{ __('State') }}</label>

                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Town field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('town_id') is-invalid @enderror" name="town_id" id="town_id">
                                    <option value="" disabled {{ old('town_id', $user->town_id) ? '' : 'selected' }}>Select Town</option>
                                    @foreach($towns as $town)
                                    <option value="{{ $town['id'] }}" {{ old('town_id', $user->town_id) == $town['id'] ? 'selected' : '' }}>
                                    {{ $town['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                                <label for="town_id" class="form-label">{{ __('Town') }}</label>

                                @error('town_id')
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
                            @if($user->profile)
                            <div class="col-auto">
                                <label class="form-label d-block mb-2">{{ __('Current Profile Image') }}</label>
                                <img src="{{ asset('storage/' . $user->profile) }}" alt="{{ $user->name }}" class="img-thumbnail" style="max-width: 150px;">
                            </div>
                            @endif
                            <div class="col">
                                <div class="d-flex justify-content-end gap-2 mb-5">
                                    <a href="{{ url('/users') }}" class="btn btn-danger">Cancel</a>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stateSelect = document.getElementById('state_id');
            const townSelect = document.getElementById('town_id');
            const allTowns = @json($towns);

            function filterTownsByState(stateId) {
                while (townSelect.options.length > 1) {
                    townSelect.remove(1);
                }
                if (!stateId) return;
                allTowns.forEach(function (town) {
                    if (town.state_id == stateId) {
                        const option = document.createElement('option');
                        option.value = town.id;
                        option.text = town.name;
                        if ("{{ old('town_id', $user->town_id) }}" == town.id) {
                            option.selected = true;
                        }
                        townSelect.appendChild(option);
                    }
                });
            }

            stateSelect.addEventListener('change', function () {
                filterTownsByState(this.value);
            });

            filterTownsByState(stateSelect.value);
        });
    </script>
@endpush
