@extends('auth.form')


@section('content')
    <form class="form-signin" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="text-center mb-4">
            @yield('formhead')
            <img class="mb-4" src="https://easycep.com/wp-content/uploads/2022/01/header-easycep-moto-logo.png.webp" alt="" height="72">
        </div>

        <div class="form-label-group">
            <input type="email" id="inputEmail" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autofocus autocomplete="email">
            <label for="inputEmail">{{ __('E-Mail Address') }}</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPassword" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required autocomplete="current-password">
            <label for="inputPassword">{{ __('Password') }}</label>
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember me
            </label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Login') }}</button>
        <div>
            @if (Route::has('register'))
                <a class="btn btn-link float-right" href="{{ route('register') }}">
                    {{ __('Register') }}
                </a>
            @endif
        </div>

    </form>
@endsection

