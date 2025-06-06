@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Task') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/tasks/update/' . $task->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- name field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $task->name) }}" autocomplete="name" autofocus>

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
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" autocomplete="description">{{ old('description', $task->description) }}</textarea>

                                <label for="description" class="form-label">{{ __('Description') }}</label>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Priority field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('priority') is-invalid @enderror" name="priority" id="priority">
                                    <option value="" disabled {{ old('priority', $task->priority) ? '' : 'selected' }}>Select Priority</option>
                                    <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                                    <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                                </select>

                                <label for="priority" class="form-label">{{ __('Priority') }}</label>

                                @error('priority')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Type field --}}
<div class="mb-3">
    <div class="form-floating">
        <select class="form-select @error('type') is-invalid @enderror" name="type" id="type">
            <option value="" disabled {{ old('type', $task->type) ? '' : 'selected' }}>Select Type</option>
            <option value="requirement" {{ old('type', $task->type) == 'requirement' ? 'selected' : '' }}>Requirement</option>
            <option value="design" {{ old('type', $task->type) == 'design' ? 'selected' : '' }}>Design</option>
            <option value="development" {{ old('type', $task->type) == 'development' ? 'selected' : '' }}>Development</option>
            <option value="testing" {{ old('type', $task->type) == 'testing' ? 'selected' : '' }}>Testing</option>
            <option value="deployment" {{ old('type', $task->type) == 'deployment' ? 'selected' : '' }}>Deployment</option>
            <option value="maintenance" {{ old('type', $task->type) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
        </select>

        <label for="type" class="form-label">{{ __('Type') }}</label>

        @error('type')
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
                                    <option value="" disabled {{ old('project_id', $task->project_id) ? '' : 'selected' }}>Select Project</option>
                                    @foreach($projects as $project)
                                    <option value="{{ $project['id'] }}" {{ old('project_id', $task->project_id) == $project['id'] ? 'selected' : '' }}>
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
                        
                        {{-- Team field --}}
                        <div class="mb-3">
                            <div class="form-floating">
                                <select class="form-select @error('team_id') is-invalid @enderror" name="team_id" id="team_id">
                                    <option value="" disabled {{ old('team_id', $task->team_id) ? '' : 'selected' }}>Select Team</option>
                                    @foreach($teams as $team)
                                    <option value="{{ $team['id'] }}" {{ old('team_id', $task->team_id) == $team['id'] ? 'selected' : '' }}>
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

                        {{-- submit cancel buttons --}}
                        <div class="row mb-0">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ url('/tasks') }}" class="btn btn-danger">Cancel</a>
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


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const projectSelect = document.getElementById('project_id');
            const teamSelect = document.getElementById('team_id');
            const allTeams = @json($teams);
            const selectedTeamId = "{{ old('team_id', $task->team_id) }}";

            function filterTeamsByProject(projectId) {
                // Clear all options except the placeholder
                while (teamSelect.options.length > 1) {
                    teamSelect.remove(1);
                }

                if (!projectId) return;

                allTeams.forEach(function (team) {
                    if (team.project_id == projectId) {
                        const option = document.createElement('option');
                        option.value = team.id;
                        option.text = team.name;
                        if (selectedTeamId == team.id) {
                            option.selected = true;
                        }
                        teamSelect.appendChild(option);
                    }
                });
            }

            projectSelect.addEventListener('change', function () {
                filterTeamsByProject(this.value);
            });

            // Call on page load
            filterTeamsByProject(projectSelect.value);
        });
    </script>

@endpush
