@extends('layouts.user')

@section('title', 'Мои магазины')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center">
            <h3 class="text-gray-700 text-3xl font-medium">{{ __('Магазин') }} -
                <span class="text-2xl">{{ $merchant->m_id}}</span>
            </h3>
            <span
                class="float-right text-sm font-semibold py-1 px-3 border-2 border-yellow-400 rounded shadow transition duration-300 hover:border-black hover:text-yellow-400">
                <a href="{{ route('merchant') }}">Назад</a>
            </span>
        </div>
        <div class="flex items-center mt-5 justify-between">
            <span class="font-semibold {{ $merchant->activated ? 'text-lime-600' : 'text-red-600' }}">
                {{ __('Статус') }} - {{ $merchant->activated ? __('Активный') : __('Неактивный') }}
            </span>
            <div class="flex gap-4">
                <a href="{{route('merchant.edit', [$merchant->id])}}"
                   class="group relative inline-block overflow-hidden border border-gold-300 px-8 py-3 focus:outline-none focus:ring">
                    <span
                        class="absolute inset-y-0 left-0 w-[2px] bg-gold-300 transition-all group-hover:w-full group-active:bg-gold-300"></span>
                    <span class="relative text-sm font-medium text-black transition-colors group-hover:text-black">
                        {{ __('Редактировать') }}
                    </span>
                </a>
                <form action="{{ route("merchant.destroy", $merchant->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="group relative inline-block overflow-hidden border border-red-600 px-8 py-3 focus:outline-none focus:ring">
                        <span
                            class="absolute inset-y-0 left-0 w-[2px] bg-red-600 transition-all group-hover:w-full group-active:bg-red-600"></span>
                        <span class="relative text-sm font-medium text-black transition-colors group-hover:text-black">
                            {{ __('Удалить') }}
                        </span>
                    </button>
                </form>
            </div>
        </div>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <div class="lg:flex">
                        <div class="px-2 py-4 lg:w-1/2">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text"
                                       value="{{ $merchant->title }}"
                                       disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Название') }}
                                    </span>
                            </label>
                        </div>

                        <div class="px-2 py-4 lg:w-1/2">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text"
                                       value="{{ $merchant->base_url }}"
                                       disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Домен') }}
                                    </span>
                            </label>
                        </div>
                    </div>
                    <div class="lg:flex">
                        <div class="px-2 py-4 lg:w-1/2">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text"
                                       value="{{ $merchant->m_id }}"
                                       disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('ID') }}
                                    </span>
                            </label>
                        </div>

                        <div class="px-2 py-4 lg:w-1/2">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text"
                                       value="{{ $merchant->m_key }}"
                                       disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Ключ') }}
                                    </span>
                            </label>
                        </div>
                    </div>
                    <div class="lg:flex">
                        <div class="px-2 py-4 lg:w-1/3">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text"
                                       value="{{ $merchant->success_url }}"
                                       disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('URL успешной оплаты') }}
                                </span>
                            </label>
                        </div>

                        <div class="px-2 py-4 lg:w-1/3">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text"
                                       value="{{ $merchant->fail_url }}"
                                       disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('URL неуспешной оплаты') }}
                                </span>
                            </label>
                        </div>

                        <div class="px-2 py-4 lg:w-1/3">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text"
                                       value="{{ $merchant->handler_url }}"
                                       disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('URL обработчика') }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        @if($merchant->rejected)
                            <div class="flex justify-center m-5">
                                <span
                                    class="text-xl font-semibold text-red-600 px-10 py-2 border-dashed border-2 border-red-600">
                                    {{ __('Отказано') }}
                                </span>
                            </div>
                        @elseif($merchant->approved && $merchant->activated)
                            <div class="px-2 py-4">
                                <form method="POST" action="{{route('merchant.activate', $merchant->id)}}">
                                    @csrf
                                    <button type="submit"
                                            class="group relative inline-block overflow-hidden border border-red-600 px-8 py-3 focus:outline-none focus:ring">
                                    <span
                                        class="absolute inset-y-0 left-0 w-[2px] bg-red-600 transition-all group-hover:w-full group-active:bg-red-600"></span>
                                        <span
                                            class="relative text-sm font-medium text-black transition-colors group-hover:text-black">
                                        {{ __('Отключить') }}
                                    </span>
                                    </button>
                                </form>
                            </div>
                        @elseif($merchant->approved && !$merchant->activated && !$merchant->banned)
                            <div class="px-2 py-4">
                                <form method="POST" action="{{route('merchant.activate', $merchant->id)}}">
                                    @csrf
                                    <button type="submit"
                                            class="group relative inline-block overflow-hidden border border-yellow-400 px-8 py-3 focus:outline-none focus:ring">
                                    <span
                                        class="absolute inset-y-0 left-0 w-[2px] bg-yellow-400 transition-all group-hover:w-full group-active:bg-yellow-400"></span>
                                        <span
                                            class="relative text-sm font-medium text-black transition-colors group-hover:text-black">
                                        {{ __('Активировать') }}
                                    </span>
                                    </button>
                                </form>
                            </div>
                        @elseif($merchant->banned)
                            <div class="flex justify-center m-5">
                                <span
                                    class="text-xl font-semibold text-red-600 px-10 py-2 border-dashed border-2 border-red-600">
                                    {{ __('Заблокировано') }}
                                </span>
                            </div>
                        @else
                            <div class="flex justify-center m-5">
                                <span
                                    class="text-xl font-semibold text-yellow-600 px-10 py-2 border-dashed border-2 border-yellow-600">
                                    {{ __('На модерации') }}
                                </span>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
