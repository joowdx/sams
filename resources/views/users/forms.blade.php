@csrf
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

    <div class="form-group row">
        <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Office') }}</label>
        <div class="col-md-6">
            <select class="form-control @error('type') is-invalid @enderror custom-select type" id="type" name="type" required>
                <option aria-placeholder="">---</option>
                @foreach([
                "admin"         =>  "Admin",
                "h.r."          =>  "Human Resouce",
                "faculty"       =>  "Faculty",
                ] as $type      => $user_label)
                <option value="{{ $type }}">{{ $user_label }}</option>
                @endforeach
            </select>
            @error('type')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $user->name }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

        <div class="col-md-6">
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') ?? $user->username }}" required autocomplete="username" autofocus>

            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

        <div class="col-md-6">
            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') ?? $user->phone }}" required autocomplete="phone" autofocus>

            @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? $user->email }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
