<x-guest-layout>
    <h1 class="text-3xl font-bold text-center text-white mb-6">{{__('Login')}}</h1>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" novalidate>
    @csrf
        <div class="mb-5">
            <x-input-label for="email" class="text-white" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="mb-5">
            <x-input-label for="password" class="text-white" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-300 border-gray-400 dark:border-gray-500 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-white dark:text-gray-200">{{ __('Recordarme') }}</span>
            </label>
        </div>
        <div class="flex justify-between my-4">
            <x-link :href="route('password.request')">{{__('Forgot your password?')}}</x-link>
        </div>
        <x-primary-button>
            {{ __('Log in') }}
        </x-primary-button>
    </form>
    <div class="mt-4">
        <x-link :href="route('register')">{{__("Don't you have a acount?")}}</x-link>
        <a href="{{ route('register') }}" class="block bg-sky-600 hover:bg-sky-700 text-center text-white font-bold w-full p-3 rounded-lg">Registrarse</a>
    </div>
</x-guest-layout>
