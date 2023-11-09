@extends('layouts.admin')

@section('title', 'Платежные системы')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Платежные системы')  }}</h3>
        <div class="my-8">
            <a href="{{ route("admin.ps.create") }}"
               class="bg-yellow-400 hover:bg-black hover:text-yellow-400 text-black font-bold py-2 px-4 rounded transition duration-300">
                {{ __('Добавить платежную систему') }}
            </a>
        </div>
        <div class="flex flex-wrap justify-center px-5 py-5 gap-4 lg:gap-20">
            @foreach($paySystems as $paySystem)
                <div
                    class="rounded-xl w-full shadow-2xl md:w-1/2 xl:w-1/3 bg-white p-4 ring ring-yellow-50 sm:p-6 lg:p-8">
                    <div class="flex items-start sm:gap-8">
                        <div
                            class="hidden sm:grid sm:h-20 sm:w-20 sm:shrink-0 sm:place-content-center"
                            aria-hidden="true">
                            <div class="flex items-center gap-1">
                                <img class="rounded-2xl"
                                     src="{{ asset('storage/' . $paySystem->logo) }}"
                                     alt="">
                            </div>
                        </div>

                        <div>
                            <span
                                class="rounded border border-yellow-400 bg-yellow-400 px-3 py-1.5 text-[14px] font-bold text-black">
                                {{__($paySystem->title)}}
                            </span>
                            <span
                                class="rounded-full border ml-5 border-sky-400 bg-sky-600 px-3 py-1.5 text-[12px] font-bold text-white">
                                {{__($paySystem->currency)}}
                            </span>

                            <h3 class="mt-4 text-sm font-medium">
                                <p>  {{ __($paySystem->desc) }} </p>
                            </h3>

                            <div class="mt-4 flex flex-wrap items-center gap-2">
                                <form action="{{route('admin.ps.change', $paySystem->id)}}" method="POST">
                                    @csrf
                                    <button
                                        class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                                        <span
                                            class="absolute inset-0 border group-active:border-{{ $paySystem->activated ? 'red-500' : 'lime-500' }}"></span>
                                        <span
                                            class="block border bg-{{ $paySystem->activated ? 'red-600' : 'lime-600' }} px-2 py-1 transition-transform active:bg-{{ $paySystem->activated ? 'red-500' : 'lime-500' }} group-hover:-translate-x-1 group-hover:-translate-y-1">
                                            {{ $paySystem->activated ? __('Выкл') : __('Вкл') }}
                                        </span>
                                    </button>
                                </form>

                                <a href="{{route('admin.ps.edit', $paySystem->id)}}"
                                   class="group relative cursor-pointer inline-block text-sm font-medium text-black focus:outline-none focus:ring">
                                    <span
                                        class="absolute inset-0 border border-yellow-400 group-active:border-yellow-300"></span>
                                    <span
                                        class="block border border-yellow-400 bg-yellow-400 px-2 py-1 transition-transform active:border-yellow-300 active:bg-yellow-300 group-hover:-translate-x-1 group-hover:-translate-y-1">
                                            {{__('Редактировать')}}
                                    </span>
                                </a>

                                <a href="{{route('admin.ps.info.show', $paySystem->id)}}"
                                   class="group relative cursor-pointer inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                                    <span
                                        class="absolute inset-0 border border-blue-400 group-active:border-blue-300"></span>
                                    <span
                                        class="block border border-blue-400 bg-blue-400 px-2 py-1 transition-transform active:border-blue-300 active:bg-blue-300 group-hover:-translate-x-1 group-hover:-translate-y-1">
                                            {{__('Реквизиты')}}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
