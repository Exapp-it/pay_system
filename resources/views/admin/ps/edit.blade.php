@extends('layouts.admin')

@section('title', 'Платежные системы')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Редактирование платежной системы') }}
            - {{$paySystem->title}}
            <span
                class="float-right text-sm font-semibold py-1 px-3 border-2 border-yellow-400 rounded shadow transition duration-300 hover:border-black hover:text-yellow-400">
            <a href="{{ route('admin.ps') }}">Назад</a>
        </span>
        </h3>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <form action="{{route('admin.ps.update', $paySystem->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <div class="lg:flex items-center mt-5">
                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <input type="text"
                                           name="title"
                                           id="title"
                                           value="{{ $paySystem->title }}"
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="title"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('Название') }}
                                    </label>
                                </div>

                                @error('title')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <input type="text"
                                           name="url"
                                           id="url"
                                           value="{{ $paySystem->url }}"
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="url"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('Домен') }}
                                    </label>
                                </div>
                                @error('url')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                        <div class="lg:flex items-center m-3">
                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <textarea name="desc" id="desc"
                                              class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">{{$paySystem->desc}}</textarea>
                                    <label for="desc"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('Описание') }}
                                    </label>
                                </div>
                                @error('desc')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div x-data="{ imageUrl: '', imageUploaded: false }"
                                 class="flex items-center space-x-6 px-2 py-4 lg:w-1/2">
                                <div class="shrink-0">
                                    <img x-show="imageUploaded" x-bind:src="imageUrl"
                                         class="w-20 object-cover rounded" alt="Payment System Logo"/>
                                    <img x-show="!imageUploaded" src="{{asset('storage/' . $paySystem->logo)}}"
                                         class="w-20 object-cover rounded" alt="Payment System Logo"/>
                                </div>
                                <label class="block">
                                    <span class="sr-only">{{ __('Выберите логотип') }}</span>
                                    <input type="file"
                                           name="logo"
                                           x-on:change="imageUploaded = true; imageUrl = URL.createObjectURL($event.target.files[0])"
                                           class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-1 file:border-yellow-400 file:text-sm file:font-semibold file:bg-yellow-50 file:text-black hover:file:bg-yellow-400 file:cursor-pointer"/>
                                </label>
                                @error('logo')
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
                                            {{ __('Сохранить')  }}
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
