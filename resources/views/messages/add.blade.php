@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">{{ __('Send Message') }}</div>

            <div class="card-body">
                <form method="POST" action="{{ url('/messages/create') }}">
                    @csrf

                    {{-- Receiver --}}
                    <div class="mb-3">
                        <div class="form-floating">
                            <select name="receiver_id" class="form-select @error('receiver_id') is-invalid @enderror">
                                <option disabled selected>Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ old('receiver_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <label for="receiver_id">{{ __('Recipient') }}</label>
                            @error('receiver_id')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Message --}}
                    <div class="mb-3">
                        <div class="form-floating">
                            <textarea name="message" class="form-control @error('message') is-invalid @enderror" style="height: 100px;">{{ old('message') }}</textarea>
                            <label for="message">{{ __('Message') }}</label>
                            @error('message')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ url('/messages') }}" class="btn btn-danger">Cancel</a>
                        <button class="btn btn-primary">{{ __('Send') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
