@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Team Member') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/team-members/update/' . $teammember->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Team field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select  @error('team_id') is-invalid @enderror" name="team_id" id="team_id">
                                    <option value="" disabled {{ old('team_id', $teammember->team_id) ? '' : 'selected' }}>Select Team</option>
                                    @foreach($teams as $team)
                                    <option value="{{ $team['id'] }}" {{ old('team_id', $teammember->team_id) == $team['id'] ? 'selected' : '' }}>
                                    {{ $team['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                                <label for="team_id" class="form-label">{{ __('Team') }}</label>

                                @error('team_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- User field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select  @error('user_id') is-invalid @enderror" name="user_id" id="user_id">
                                    <option value="" disabled {{ old('user_id', $teammember->user_id) ? '' : 'selected' }}>Select User</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user['id'] }}" {{ old('user_id', $teammember->user_id) == $user['id'] ? 'selected' : '' }}>
                                    {{ $user['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                                <label for="user_id" class="form-label">{{ __('User') }}</label>

                                @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Role field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('role') is-invalid @enderror" name="role" id="role">
                                    <option value="" disabled {{ old('role', $teammember->role) ? '' : 'selected' }}>Select Role</option>
                                    <option value="team_lead" {{ old('role', $teammember->role) == 'team_lead' ? 'selected' : '' }}>Team Lead</option>
                                    <option value="developer" {{ old('role', $teammember->role) == 'developer' ? 'selected' : '' }}>Developer</option>
                                    <option value="designer" {{ old('role', $teammember->role) == 'designer' ? 'selected' : '' }}>Designer</option>
                                    <option value="assistant" {{ old('role', $teammember->role) == 'assistant' ? 'selected' : '' }}>Assistant</option>
                                </select>

                                <label for="role" class="form-label">{{ __('Role') }}</label>

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- submit cancel buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/team-members') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
