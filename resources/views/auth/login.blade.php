@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Centrar la imagen -->
                        <div class="col-md-12 text-center">
                            <img style="width: 300px;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/45/U._Cooperativa_de_Colombia_logo.svg/1920px-U._Cooperativa_de_Colombia_logo.svg.png" alt="Logo de la Universidad Cooperativa de Colombia">
                        </div>

                        <div class="row mb-3 mt-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <br/>
                        <br/>

                        <div class="row mb-0 text-center">

                            <div class="col-md-8 offset-md-4">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                    let scale = 1;
                                    scale += 0.1; // Incrementa la escala
                                    document.body.style.transform = `scale(${scale})`;"
                                    >
                                  {{ __('Aumenta') }}
                                </a>
                            </div>

                            <div class="col-md-8 offset-md-4">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                    let scale = 1;
                                    if (scale > 0.1) {
                                        scale -= 0.1; // Reduce la escala
                                        document.body.style.transform = `scale(${scale})`;
                                    }
                                    ">
                                  {{ __('Disminuye') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
