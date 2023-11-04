@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <div class="h-screen bg-white flex flex-col space-y-10 justify-center items-center">
        <div class="bg-white w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl text-center font-medium">{{ __('Регистрация') }}</h1>

            <form action="{{ route("register") }}" class="space-y-5 mt-5" method="POST">
                @csrf

                <input name="username" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('username') border-red-500 @enderror" placeholder="Имя" />

                @error('username')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="email" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('email') border-red-500 @enderror" placeholder="Email" />

                @error('email')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Пароль" />

                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password_confirmation" type="password" class="w-full h-12 border border-gray-800 rounded px-3 @error('password_confirmation') border-red-500 @enderror" placeholder="Подтверждение пароля" />

                @error('password_confirmation')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div>
                    <a href="{{ route("login") }}" class="font-medium text-blue-900 hover:bg-blue-300 rounded-md p-2">{{ __('Есть аккаунт?') }}</a>
                </div>

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">{{ __('Зарегистрироваться') }}</button>
            </form>
        </div>
    </div>
@endsection
