@extends('layouts.app2')

@section('content')
<style>
    .mini-hr {
           border: none; 
           height: 5px;
           background-color: #1ae907; 
           width: 150px;
           margin-left: 5px; 
           margin-top: 5px; 
          
       }
</style>
<body  style="background-color: #f1f4f9;">
    
   <div class="container">
    <div class="row ">
        <div class="col-md-4">
            <img src="/images/x.png" width="100%">
        </div>
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="custom-header">
                        <strong>
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0m-9 8c0 1 1 1 1 1h5v-1a2 2 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693Q8.844 9.002 8 9c-5 0-6 3-6 4m7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1"/>
                            </svg>
                            {{ __('Inscription  Admin') }}
                        </strong>
                    </h4>
                    <hr class="mini-hr">

                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register.admin') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('Nom') }} <span style="color: red">*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">{{ __('Prenom') }} <span style="color: red">*</span></label>
                                <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom">
                                @error('prenom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="tel" class="form-label">{{ __('Tel') }} <span style="color: red">*</span></label>
                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">
                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">{{ __('Address') }} <span style="color: red">*</span></label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cin" class="form-label">{{ __('CIN') }} <span style="color: red">*</span></label>
                                <input id="cin" type="text" class="form-control @error('cin') is-invalid @enderror" name="cin" value="{{ old('cin') }}" required autocomplete="cin">
                                @error('cin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }} <span style="color: red">*</span></label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="password" class="form-label">{{ __('Password') }} <span style="color: red">*</span></label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }} <span style="color: red">*</span></label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12" style="float: right">
                                <button type="submit" class="btn custom-orange" style="float: right">
                                    {{ __('Envoyer') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> 
</body>
@include('layouts.footer')
<style>
    .custom-orange {
        background-color: #ff6105;
        border-color: #FFA500;
        color: white;
    }
    .custom-header {
        color: rgb(255, 147, 64);
        display: flex;
        align-items: center;
    }
    .custom-header svg {
        margin-right: 10px;
    }
    .custom-orange :hover {
        border-color: #FFA500;
        color: rgb(246, 0, 0);
    }
</style>
@endsection
