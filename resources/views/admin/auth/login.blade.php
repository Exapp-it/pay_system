@extends('layouts.app')

@section('title', 'Авторизация')

@section('content')
    <div class="h-screen bg-gray-100 flex flex-col space-y-10 justify-center items-center">
        <div class="bg-yellow-400 lg:w-96 shadow-xl rounded p-5">
            <h1 class="text-3xl text-center font-semibold">{{ __('Вход в панель администратора') }}</h1>

            <form method="POST" action="{{ route("admin.login.store") }}" class="space-y-5 mt-5">
                @csrf

                <input name="username" type="text" class="w-full h-12 bg-black text-yellow-400 focus:ring-0 focus:ring-offset-0  rounded px-3 @error('email') border-red-500 @enderror" placeholder="Логин" />

                @error('username')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="password" type="password" class="w-full h-12 bg-black text-yellow-400 focus:ring-0 focus:ring-offset-0 rounded px-3 @error('password') border-red-500 @enderror" placeholder="Пароль" />

                @error('password')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-black rounded-md text-yellow-400 py-3 font-medium">Войти</button>
            </form>
        </div>
    </div>
@endsection
