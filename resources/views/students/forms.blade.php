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
    <label for="school_id" class="col-md-4 col-form-label text-md-right">{{ __('School ID') }}</label>
    <div class="col-md-6">
        <input id="school_id" type="text" class="form-control @error('school_id') is-invalid @enderror" name="school_id" value="{{ old('school_id') ?? $student->school_id ?? '' }}" required autocomplete="username" autofocus>
        @error('school_id')
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
    <label for="faculty_id" class="col-md-4 col-form-label text-md-right">Department</label>
    <div class="col-md-6">
        <select id="department_id" name="department_id" data-width="100%" data-live-search="true">
            @foreach ($departments as $department)
            <option value="{{ $department->id }}" {{ @$student->department->id == $department->id ? 'selected' : '' }}> {{  $department->shortname }} </option>
            @endforeach
        </select>
    </div>
</div>
