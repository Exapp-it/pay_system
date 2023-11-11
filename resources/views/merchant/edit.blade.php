@extends('layouts.user')

@section('title', 'Мои магазины')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex justify-between items-center">
            <h3 class="text-gray-700 text-3xl font-medium">{{ __('Редактирование магазина') }} -
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
        </div>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <form method="POST" action="{{route('merchant.update', $merchant->id)}}">
                    @csrf
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <div class="lg:flex pt-5">
                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <input type="text"
                                           name="title"
                                           id="title"
                                           value="{{ $merchant->title }}"
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="title"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('Название') }}
                                    </label>
                                </div>
                            </div>

                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <input type="text"
                                           id="base_url"
                                           value="{{ $merchant->base_url }}"
                                           disabled
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="base_url"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('Домен') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="lg:flex">
                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <input type="text"
                                           id="m_id"
                                           value="{{ $merchant->m_id }}"
                                           disabled
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="m_id"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('ID') }}
                                    </label>
                                </div>
                            </div>

                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <input type="text"
                                           name="m_key"
                                           id="m_key"
                                           value="{{ $merchant->m_key }}"
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="m_key"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('Ключ') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="lg:flex">
                            <div class="px-2 py-4 lg:w-1/3">
                                <div class="relative">
                                    <input type="text"
                                           name="success_url"
                                           id="success_url"
                                           value="{{ $merchant->success_url }}"
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="success_url"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('URL успешной оплаты') }}
                                    </label>
                                </div>
                            </div>

                            <div class="px-2 py-4 lg:w-1/3">
                                <div class="relative">
                                    <input type="text"
                                           name="fail_url"
                                           id="fail_url"
                                           value="{{ $merchant->fail_url }}"
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="fail_url"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('URL неудачной оплаты') }}
                                    </label>
                                </div>
                            </div>

                            <div class="px-2 py-4 lg:w-1/3">
                                <div class="relative">
                                    <input type="text"
                                           name="handler_url"
                                           id="handler_url"
                                           value="{{ $merchant->handler_url }}"
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="handler_url"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('URL успешной оплаты') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="px-2 py-4">
                                <button type="submit"
                                        class="group relative inline-block overflow-hidden border border-gold-300 px-8 py-3 focus:outline-none focus:ring">
                                    <span
                                        class="absolute inset-y-0 left-0 w-[2px] bg-gold-300 transition-all group-hover:w-full group-active:bg-gold-300"></span>
                                    <span
                                        class="relative text-sm font-medium text-black transition-colors group-hover:text-black">
                                            {{ __('Сохранить') }}
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

