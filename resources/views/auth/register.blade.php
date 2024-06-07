@extends('layouts.plantilla')

@section('title', 'Register')

@section('content')
<div class="container" style="padding-top:10%;text-align: center; display:flex; justify-content:center;">
        <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12" style="padding: 10px">
            <div class="card" style="width: 18rem;">
    <div class="card-body">
        <div class="extras" aria-multiselectable="true">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nia -->
        <div>
            <x-input-label for="nia" :value="__('Nia')" />
            <x-text-input id="nia" class="block mt-1 w-full" type="text" name="nia" :value="old('nia')" required autofocus autocomplete="nia" />
            <x-input-error :messages="$errors->get('nia')" class="mt-2" />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>
        <br>
            <x-primary-button class="btn btn-primary">
                {{ __('Registrarse') }}
            </x-primary-button>
        </div>
    </form>
</div>
</div>
</div><a href="{{route('login')}}">Login</a>
</div>
</div>
