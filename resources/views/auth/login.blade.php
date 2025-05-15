<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Título do cabeçalho -->
    <div class="header bg-blue-600 text-white py-6 mb-5 rounded-lg shadow-lg relative flex justify-center items-center space-x-4">
        <img src="{{ asset('storage/imagem/logo2.png') }}" alt="Logo" class="logo">
        <h1 class="header-title text-2xl font-semibold">Inicie sessão</h1>
    </div>



    <!-- Formulário de login -->
    <form method="POST" action="{{ route('login') }}" class="bg-white p-8 shadow-2xl rounded-lg max-w-md mx-auto mt-6">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" class="text-black font-semibold" />
            <x-text-input id="email" class="block mt-2 w-full border-2 border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 transition-all duration-300" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Senha')" class="text-black font-semibold" />
            <x-text-input id="password" class="block mt-2 w-full border-2 border-gray-300 rounded-lg p-4 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-100 transition-all duration-300" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between mt-4 mb-6">
            <label for="remember_me" class="inline-flex items-center text-sm">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-gray-600">{{ __('Lembrar-me') }}</span>
            </label>
        </div>

       <!-- Button -->
        <div class="mt-4">
            <x-primary-button class="bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all duration-300">
                {{ __('Entrar') }}
            </x-primary-button>
        </div>



        <!-- Link to Register -->
        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Não tem uma conta? <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">{{ __('Cadastrar') }}</a>
            </p>
        </div>
    </form>
</x-guest-layout>
