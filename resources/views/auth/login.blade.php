@extends('layouts.plantilla')

@section('title', 'Login')

@section('content')
    <div class="container" style="padding-top:10%;text-align: center; display:flex; justify-content:center;">
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 10px">
            <div class="card" style="width: 18rem;">
    <div class="card-body">
        <div class="extras" aria-multiselectable="true">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="btn btn-primary">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</div>
</div>
</div><a href="{{route('register')}}">Registrarse</a>
</div>
</div>
</div>
</div>

@endsection
