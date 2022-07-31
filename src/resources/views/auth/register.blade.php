<link rel="stylesheet" href="{{ asset('css/registration.css') }}">
<x-guest-layout>
    <x-auth-card-registration>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mt-2 mr-4">
                <div class="user-icon"><img src="{{Storage::url('img/icon_user.svg')}}" alt=""></div>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" placeholder='Username' required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-2 mr-4">
                <div class="mail-icon"><img src="{{Storage::url('img/icon_mail.svg')}}" alt=""></div>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder='Email' required />
            </div>

            <!-- Password -->
            <div class="mt-2 mr-4">
                <div class="lock-icon"><img src="{{Storage::url('img/icon_lock.svg')}}" alt=""></div>
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                placeholder='Passward'
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-2 mr-4">
                <div class="lock-icon"><img src="" alt=""></div>
                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation"
                                placeholder='Passward Confrimation'
                                required />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    登録
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
