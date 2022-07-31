<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<x-guest-layout>
      
    <x-auth-card-login>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="email-form">
                <div class="mail-icon"><img src="{{Storage::url('img/icon_mail.svg')}}" alt=""></div>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder='Email' required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <div class="lock-icon"><img src="{{Storage::url('img/icon_lock.svg')}}" alt=""></div>
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                placeholder='Password'
                                required autocomplete="current-password"
                                />
            </div>
            <div class="ml-3-container">
                <x-button class="ml-3">
                    ログイン
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

