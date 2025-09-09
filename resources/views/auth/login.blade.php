@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                <div class="card-header bg-gradient-pink text-white py-3" style="background: linear-gradient(135deg, #FF69B4, #ff6b6b);">
                    <h4 class="mb-0 text-center font-weight-bold">{{ __('Welcome Back!') }}</h4>
                </div>

                <div class="card-body py-4" style="background-color: #FFF0F5;">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end" style="color: #ff6b6b;">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0" style="color: #FF69B4;">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input id="email" type="email" class="form-control border-left-0 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus style="border-color: #FF69B4; border-radius: 0 5px 5px 0;">
                                </div>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="password" class="col-md-4 col-form-label text-md-end" style="color: #D81B60;">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0" style="color: #FF69B4;">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input id="password" type="password" class="form-control border-left-0 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="border-color: #FF69B4; border-radius: 0 5px 5px 0;">
                                </div>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="accent-color: #FF1493;">

                                    <label class="form-check-label" for="remember" style="color: #D81B60;">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn text-white px-4 py-2" style="background: linear-gradient(135deg, #FF69B4, #FF1493); border-radius: 25px; box-shadow: 0 4px 6px rgba(255, 20, 147, 0.3);">
                                    <i class="fas fa-sign-in-alt mr-2"></i> {{ __('Sign In') }}
                                </button>

                               
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Make sure to add Font Awesome to your layout for the icons -->
@if(!Session::has('font_awesome_loaded'))
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    @php
        Session::put('font_awesome_loaded', true);
    @endphp
@endif

<style>
    .bg-gradient-pink {
        background: linear-gradient(135deg, #FF69B4, #FF1493);
    }

    .form-control:focus {
        border-color: #FF1493;
        box-shadow: 0 0 0 0.2rem rgba(255, 20, 147, 0.25);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #FF1493, #C71585) !important;
        border-color: #C71585 !important;
    }

    .invalid-feedback {
        color: #FF0066;
    }
</style>
@endsection
