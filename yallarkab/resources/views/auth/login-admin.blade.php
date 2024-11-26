@extends('layouts.app2')

@section('content')
<body  style="background-color: #f1f4f9;">
    <div class="container mt-5" >
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="/images/la.png" class="img-fluid" alt="Logo">
            </div>
            <br>
            <div class="col-md-6" style="margin-top: 40px">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="text-center" style="color: rgb(255, 147, 64)">
                            <strong>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
                                </svg>  {{ __('Authentification Admin') }}
                            </strong>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login.admin') }}">
                            @csrf
    
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail ') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
    
                            <div class="mb-3 form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
    
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn" style="background-color: rgb(255 133 27); color:rgb(255, 255, 255);">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('layouts.footer')

@endsection
