@extends('layouts.user')

@section('title', 'Подключение магазина')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Подключение магазина') }}
            <span
                class="float-right text-sm font-semibold py-1 px-3 border-2 border-yellow-400 rounded shadow transition duration-300 hover:border-black hover:text-yellow-400">
            <a href="{{ route('merchant') }}">Назад</a>
        </span>
        </h3>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <form action="{{route('merchant.store')}}" method="POST">
                    @csrf
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <div class="lg:flex">
                            <div class="px-2 py-4 lg:w-1/2">
                                <label for="title"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text"
                                           name="title"
                                           id="title"
                                           value="{{ old('title') }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Название') }}
                                    </span>
                                </label>

                                @error('title')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-2 py-4 lg:w-1/2">
                                <label for="base_url"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text"
                                           name="base_url"
                                           id="base_url"
                                           value="{{ old('base_url') }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Домен') }}
                                    </span>
                                </label>
                                <span class="text-gray-500 text-xs mt-2">
                                    {{ __('Удостоверьтесь, что ваш домен использует протокол (https)') }}
                                </span>
                                @error('base_url')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                        <div class="lg:flex">
                            <div class="px-2 py-4 lg:w-1/3">
                                <label for="success_url"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text"
                                           name="success_url"
                                           id="success_url"
                                           value="{{ old('success_url')  }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('URL успешной оплаты') }}
                                </span>
                                </label>
                                <span class="text-gray-500 text-xs mt-2">
                                    {{ __('Пример: success или success.php') }}
                                </span>
                                @error('success_url')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-2 py-4 lg:w-1/3">
                                <label for="fail_url"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text"
                                           name="fail_url"
                                           id="fail_url"
                                           value="{{ old('fail_url')  }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('URL неуспешной оплаты') }}
                                </span>
                                </label>
                                <span class="text-gray-500 text-xs mt-2">
                                    {{ __('Пример: fail или fail.php') }}
                                </span>
                                @error('fail_url')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-2 py-4 lg:w-1/3">
                                <label for="handler_url"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text"
                                           name="handler_url"
                                           id="handler_url"
                                           value="{{ old('handler_url') }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('URL обработчика') }}
                                </span>
                                </label>
                                <span class="text-gray-500 text-xs mt-2">
                                    {{ __('Пример: handler или handler.php') }}
                                </span>
                                @error('handler_url')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="px-2 py-4">
                                <button type="submit"
                                        class="group relative inline-block overflow-hidden border border-yellow-400 px-8 py-3 focus:outline-none focus:ring">
                                        <span
                                            class="absolute inset-y-0 left-0 w-[2px] bg-yellow-400 transition-all group-hover:w-full group-active:bg-yellow-400"></span>
                                    <span
                                        class="relative text-sm font-medium text-black  transition-colors group-hover:text-black">
                                            {{ __('Добавить')  }}
                                        </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
