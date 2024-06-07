<form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Email input -->
    <div class="form-outline mb-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus
            autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password input -->
    <div class="form-outline mb-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="form-control" type="password" name="password" required
            autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />

    </div>


    <!-- Submit button -->
    <button type="submit" class="btn btn-primary btn-block mb-4">Iniciar Sesión</button>

</form>
