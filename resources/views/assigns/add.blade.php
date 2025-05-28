@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Assign Team Member') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/assigns/create') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Task field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('task_id') is-invalid @enderror" name="task_id" id="task_id" @readonly(true)>
                                    <option value="{{ $task['id'] }}" {{ old('task_id') == $task['id'] ? 'selected' : '' }}>
                                    {{ $task['name'] }}
                                    </option>
                                </select>

                                <label for="task_id" class="form-label">{{ __('Task') }}</label>

                                @error('task_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Team Member field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('team_member_id') is-invalid @enderror" name="team_member_id" id="team_member_id">
                                    <option value="" disabled {{ old('team_member_id') ? '' : 'selected' }}>Select Team Member</option>
                                    @foreach($teammembers as $teammember)
                                    <option value="{{ $teammember['id'] }}" {{ old('team_member_id') == $teammember['id'] ? 'selected' : '' }}>
                                    {{ $teammember->user->name }} | {{ $teammember['role'] }}
                                    </option>
                                    @endforeach
                                </select>

                                <label for="team_member_id" class="form-label">{{ __('Team Member') }}</label>

                                @error('team_member_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Status field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="" disabled {{ old('status') ? '' : 'selected' }}>Select Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                </select>

                                <label for="status" class="form-label">{{ __('Status') }}</label>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="mb-3 row">
                            {{-- start date field --}}
                            <div class="col-6">
                                <div class="form-floating">
                                    <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date') }}" autocomplete="start_date">
                                    <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                                    @error('start_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- end date field --}}
                            <div class="col-6">
                                <div class="form-floating">
                                    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date') }}" autocomplete="end_date">
                                    <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        {{-- submit cancel buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/tasks') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
