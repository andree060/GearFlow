<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="bg-white p-8 shadow-2xl rounded-lg max-w-md mx-auto mt-6">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" class="text-black font-semibold" />
            <x-text-input id="name" class="block mt-1 w-full border-2 border-gray-300 rounded-lg p-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" class="text-black font-semibold" />
            <x-text-input id="email" class="block mt-1 w-full border-2 border-gray-300 rounded-lg p-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" class="text-black font-semibold" />
            <x-text-input id="password" class="block mt-1 w-full border-2 border-gray-300 rounded-lg p-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" class="text-black font-semibold" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full border-2 border-gray-300 rounded-lg p-4 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Já tem uma conta?') }}
            </a>

            <x-primary-button class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                {{ __('Cadastrar') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
