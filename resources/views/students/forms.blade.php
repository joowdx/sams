@csrf
<div class="form-group row">
    <label for="uid" class="col-md-4 col-form-label text-md-right">{{ __('UID') }}</label>
    <div class="col-md-6">
        <input id="uid" type="text" class="form-control @error('uid') is-invalid @enderror" name="uid" value="{{ old('uid') ?? $student->uid ?? '' }}" required autocomplete="username" autofocus>
        @error('uid')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="schoolid" class="col-md-4 col-form-label text-md-right">{{ __('School ID') }}</label>
    <div class="col-md-6">
        <input id="schoolid" type="text" class="form-control @error('schoolid') is-invalid @enderror" name="schoolid" value="{{ old('schoolid') ?? $student->schoolid ?? '' }}" required autocomplete="username" autofocus>
        @error('schoolid')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $student->name ?? '' }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="faculty_id" class="col-md-4 col-form-label text-md-right">Program</label>
    <div class="col-md-6">
        <select id="program_id" name="program_id" data-width="100%" data-live-search="true" data-placeholder="Program">
            <option></option>
            @foreach ($programs as $program)
                <option value="{{ $program->id }}" {{ @$student->program->id == $program->id ? 'selected' : '' }}> {{  $program->shortname }} </option>
            @endforeach
        </select>
            @error('avatar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
    </div>
</div>

<div class="form-group row">
    <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>
    <div class="col-md-6">
        <input id="avatar" type="file" class="@error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') ?? $student->avatar ?? '' }}"  autofocus>
        @error('avatar')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
