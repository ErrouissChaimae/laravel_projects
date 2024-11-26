@extends('layouts.app')

@section('content')

<style>
    body {
        font-family: Arial, sans-serif;
    }

    .illustration {
        margin-right: 20px;
    }

    .form-container {
        background-color: #ffecec;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
        margin-bottom: 20px;
    }

    .form-container label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-container input {
        width: calc(100% - 10px);
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .form-container .half-width {
        width: 48%;
        display: inline-block;
        margin-right: 4%;
    }

    .form-container .half-width:last-child {
        margin-right: 0;
    }

    .form-container .required::after {
        content: " *";
        color: red;
    }

    .form-container .button {
        background-color: rgb(255, 128, 0);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
    }

   

</style>



<div class="container">
    <div class="row">
        <div class="col">
            <div class="illustration">
                <img src="/images/x.png" alt="Illustration" width="100%">
            </div>
        </div>

        <div class="col" >
            <div class="form-container" style="border-top: 5px solid rgb(255, 106, 0)">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">{{ __('Nom') }} <span style="color: red">*</span></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="prenom" class="form-label">{{ __('Prenom') }} <span style="color: red">*</span></label>
                            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ $user->prenom }}" required autocomplete="prenom">
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
                            <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ $user->tel }}" required autocomplete="tel">
                            @error('tel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="address" class="form-label">{{ __('Address') }} <span style="color: red">*</span></label>
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"value="{{ $user->address }}" required autocomplete="address">
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3" >
                        <div class="col-md-6">
                            <label for="cin" class="form-label">{{ __('CIN') }} <span style="color: red">*</span></label>
                            <input id="cin" type="text" class="form-control @error('cin') is-invalid @enderror" name="cin" value="{{ $user->cin }}" required autocomplete="cin">
                            @error('cin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">{{ __('E-Mail Address') }} <span style="color: red">*</span></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">
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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ $user->password }}" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="button" style="float: right;">Modifier</button>

                    </div>
                    
                </form>
            </div>
        </div>

    </div>
</div>
<br>
@include('layouts.footer1')
@endsection
