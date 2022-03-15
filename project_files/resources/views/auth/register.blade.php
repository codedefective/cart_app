@extends('auth.form')

@section('content')
    <form class="form-signin" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="text-center mb-4">
            <img class="mb-4" src="https://easycep.com/wp-content/uploads/2022/01/header-easycep-moto-logo.png.webp" alt="" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Floating labels</h1>
            <p>Build form controls with floating labels via the <code>:placeholder-shown</code> pseudo-element. <a href="https://caniuse.com/#feat=css-placeholder-shown">Works in latest Chrome, Safari, and Firefox.</a></p>
        </div>

        <div class="form-label-group">
            <input type="text" id="inputName" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="{{ __('First Name and Last Name') }}" required autofocus autocomplete="name">
            <label for="inputName">{{ __('First Name and Last Name') }}</label>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
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
            <input type="password" id="inputPassword" name="password" class="form-control  @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" required autocomplete="off">
            <label for="inputPassword">{{ __('Password') }}</label>
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-label-group">
            <input type="password" id="inputPasswordRe" name="password_confirmation" class="form-control  @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Re-Password') }}" required autocomplete="off">
            <label for="inputPasswordRe">{{ __('Re-Password') }}</label>
            @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button class="btn btn-lg btn-primary btn-block" type="submit">{{ __('Register') }}</button>

        <div>
            @if (Route::has('login'))
                <a class="btn btn-link float-right" href="{{ route('login') }}">
                    {{ __('Login') }}
                </a>
            @endif
        </div>

    </form>
@endsection

