@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Town') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/towns/update/' . $town->id) }}">
                        @csrf
                        @method('PUT')
                        
                        {{-- name field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $town->name) }}" autocomplete="name" autofocus>

                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- State field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('state_id') is-invalid @enderror"" name="state_id" id="state_id">
                                    <option value="" disabled {{ old('state_id', $town->state_id) ? '' : 'selected' }}>Select State</option>
                                    @foreach($states as $state)
                                    <option value="{{ $state['id'] }}" {{ old('state_id', $town->state_id) == $state['id'] ? 'selected' : '' }}>
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

                        {{-- submit cancel buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/towns') }}" class="btn btn-danger">Cancel</a>
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
