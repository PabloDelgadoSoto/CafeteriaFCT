<form method="POST" action="{{ route('register') }}">

    @csrf

    <!-- Nia -->
    <div class="form-outline mb-4">
        <x-input-label for="nia" :value="__('N.I.A')" />
        <x-text-input id="nia" class="form-control" type="text" name="nia" :value="old('nia')" required autofocus autocomplete="nia" />
        <x-input-error :messages="$errors->get('nia')" class="mt-2" />
    </div>

    <!-- Name input -->
    <div class="form-outline mb-4">
        <x-input-label for="name" :value="__('Nombre')" />
        <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus
            autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />

    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required
            autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />

    </div>


    <div class="form-outline mb-4">
        <x-input-label for="password" :value="__('Contraseña')" />
        <x-text-input id="password" class="form-control" type="password" name="password" required
            autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="form-outline mb-4">
        <x-input-label for="password_confirmation" :value="__('Verificar contraseña')" />

        <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation"
            required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>


    <!-- Submit button -->
    <button type="submit" id="registerButton" class="btn btn-primary btn-block mb-3">
        Registrarse </button>
</form>
