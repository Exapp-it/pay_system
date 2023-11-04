<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

@extends('layouts.app')

@section('title', 'Восстановление пароля')

@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl text-center font-medium">{{ __('Восстановление пароля')  }}</h1>

            <form method="POST" action="{{ route("password.store") }}" class="space-y-5 mt-5">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <input name="email" type="text"
                       class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror"
                       placeholder="Email"/>

                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="password"
                       class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-500 @enderror"
                       placeholder="Пароль"/>

                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <a href="{{ route("login") }}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">Вспомнил
                        пароль</a>
                </div>

                <button type="submit"
                        class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">{{ __('Подтвердить')  }}</button>
            </form>
        </div>
    </div>
@endsection
