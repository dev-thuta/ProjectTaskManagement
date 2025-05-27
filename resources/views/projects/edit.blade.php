@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Project') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/projects/update/' . $project->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- name field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $project->name) }}" autocomplete="name" autofocus>

                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- description field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{ old('description', $project->description) }}</textarea>

                                <label for="description" class="form-label">{{ __('Description') }}</label>

                                @error('description')
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
                                    <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date', $project->start_date) }}" autocomplete="start_date">
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
                                    <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date', $project->end_date) }}" autocomplete="end_date">
                                    <label for="end_date" class="form-label">{{ __('End Date') }}</label>
                                    @error('end_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Status field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                                    <option value="" disabled {{ old('status', $project->status) ? '' : 'selected' }}>Select Status</option>
                                    <option value="pending" {{ old('status', $project->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="ongoing" {{ old('status', $project->status) == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                    <option value="ended" {{ old('status', $project->status) == 'ended' ? 'selected' : '' }}>Ended</option>
                                </select>

                                <label for="status" class="form-label">{{ __('Status') }}</label>

                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Client field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('client_id') is-invalid @enderror" name="client_id" id="client_id">
                                    <option value="" disabled {{ old('client_id', $project->client_id) ? '' : 'selected' }}>Select Client</option>
                                    @foreach($clients as $client)
                                    <option value="{{ $client['id'] }}" {{ old('client_id', $project->client_id) == $client['id'] ? 'selected' : '' }}>
                                    {{ $client['name'] }}
                                    </option>
                                @endforeach
                                </select>

                                <label for="client_id" class="form-label">{{ __('Client') }}</label>

                                @error('client_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        {{-- submit cancel buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/projects') }}" class="btn btn-danger">Cancel</a>
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
