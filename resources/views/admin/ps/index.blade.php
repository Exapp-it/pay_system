@extends('layouts.admin')

@section('title', 'Платежные системы')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Платежные системы')  }}</h3>

        <div class="mt-8">
            <a href="{{ route("admin.ps.create") }}"
               class="bg-yellow-400 hover:bg-black hover:text-yellow-400 text-black font-bold py-2 px-4 rounded transition duration-300">
                {{ __('Добавить платежную систему') }}
            </a>
        </div>
        <div class="flex flex-wrap justify-center px-5 py-5 gap-4 lg:gap-20">
            <div class="rounded-xl shadow-2xl lg:w-1/3 bg-white p-4 ring ring-yellow-50 sm:p-6 lg:p-8">
                <div class="flex items-start sm:gap-8">
                    <div
                        class="hidden sm:grid sm:h-20 sm:w-20 sm:shrink-0 sm:place-content-center"
                        aria-hidden="true">
                        <div class="flex items-center gap-1">
                            <img class="rounded-2xl shadow-xl"
                                 src="https://cdn6.aptoide.com/imgs/b/a/8/ba8c900c1212100bab1cc9b14b9693bd_icon.png"
                                 alt="">
                        </div>
                    </div>

                    <div>
                        <strong
                            class="rounded border border-yellow-400 bg-yellow-540 px-3 py-1.5 text-[12px] font-medium text-black">
                            Название
                        </strong>

                        <h3 class="mt-4 text-lg font-medium sm:text-xl">
                            <a href="" class="hover:underline"> Описание </a>
                        </h3>

                        <div class="mt-4 flex items-center justify-between gap-2">
                            <div class="flex items-center gap-1 text-gray-500">
                                <button
                                    class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                                <span
                                    class="absolute inset-0 border border-lime-600 group-active:border-lime-500"></span>
                                    <span
                                        class="block border border-lime-600 bg-lime-600 px-2 py-1 transition-transform active:border-lime-500 active:bg-lime-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                                        {{__('Вкл')}}
                                    </span>
                                </button>

                            </div>

                            <span class="hidden sm:block" aria-hidden="true">&middot;</span>

                            <button
                                class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                            <span
                                class="absolute inset-0 border border-yellow-400 group-active:border-yellow-300"></span>
                                <span
                                    class="block border border-yellow-400 bg-yellow-400 px-2 py-1 transition-transform active:border-yellow-300 active:bg-yellow-300 group-hover:-translate-x-1 group-hover:-translate-y-1">
                                        {{__('Изменить')}}
                                    </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
