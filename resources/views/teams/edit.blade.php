@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Team') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/teams/update/' . $team->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- name field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $team->name) }}" autocomplete="name" autofocus>

                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- Project field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('project_id') is-invalid @enderror" name="project_id" id="project_id">
                                    <option value="" disabled {{ old('project_id', $team->project_id) ? '' : 'selected' }}>Select Project</option>
                                    @foreach($projects as $project)
                                    <option value="{{ $project['id'] }}" {{ old('project_id', $team->project_id) == $project['id'] ? 'selected' : '' }}>
                                    {{ $project['name'] }}
                                    </option>
                                    @endforeach
                                </select>

                                <label for="project_id" class="form-label">{{ __('Project') }}</label>

                                @error('project_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- description field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{ old('description', $team->description) }}</textarea>

                                <label for="description" class="form-label">{{ __('Description') }}</label>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- submit cancel buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/teams') }}" class="btn btn-danger">Cancel</a>
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
