@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Assignment') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/assigns/update/' . $assign->id) }}">
                        @csrf
                        @method('PUT')

                        {{-- Task field (read-only select) --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select" id="task_id" disabled>
                                    <option value="{{ $assign->task->id }}" selected>{{ $assign->task->name }}</option>
                                </select>
                                <label for="task_id" class="form-label">{{ __('Task') }}</label>
                                <input type="hidden" name="task_id" value="{{ $assign->task->id }}">
                            </div>
                        </div>

                        {{-- Team Member field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('team_member_id') is-invalid @enderror" name="team_member_id" id="team_member_id">
                                    <option value="" disabled>Select Team Member</option>
                                    @foreach($teammembers as $teammember)
                                    <option value="{{ $teammember->id }}" {{ (old('team_member_id', $assign->team_member_id) == $teammember->id) ? 'selected' : '' }}>
                                        {{ $teammember->user->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="team_member_id" class="form-label">{{ __('Team Member') }}</label>
                                @error('team_member_id')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        {{-- Status field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="pending" {{ old('status', $assign->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ongoing" {{ old('status', $assign->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="completed" {{ old('status', $assign->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                                <label for="status" class="form-label">{{ __('Status') }}</label>
                                @error('status')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 row">
                            {{-- start date --}}
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="date" name="start_date" id="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', $assign->start_date) }}">
                                    <label for="start_date" class="form-label">{{ __('Start Date') }}</label>
                                    @error('start_date')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            {{-- end date --}}
                            <div class="col-6">
                                <div class="form-floating">
                                    <input type="date" name="end_date" id="end_date" class="form-control @error('end_date') is-invalid @enderror" value="{{ old('end_date', $assign->end_date) }}">
                                    <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                                    @error('end_date')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/assigns') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
