@extends('layouts.admin')

@section('title', 'Платежные системы')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Добавление платежной системы') }}
            <span
                class="float-right text-sm font-semibold py-1 px-3 border-2 border-yellow-400 rounded shadow transition duration-300 hover:border-black hover:text-yellow-400">
            <a href="{{ route('admin.ps') }}">Назад</a>
        </span>
        </h3>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <form action="{{route('admin.ps.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <div class="lg:flex items-center">
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
                                <label for="url"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text"
                                           name="url"
                                           id="url"
                                           value="{{ old('url') }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Домен') }}
                                    </span>
                                </label>
                                @error('url')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="px-2 py-4">
                                <label for="currency" class="block text-sm font-medium text-gray-900">
                                    {{ __('Валюта')  }}
                                </label>

                                <select
                                    name="currency"
                                    id="currency"
                                    class="rounded-lg border-gray-300 text-gray-700 sm:text-sm"
                                >
                                    <option value="">{{ __('Выберите валюту') }}</option>
                                    @foreach($currencies as $currency)
                                        <option value="{{$currency}}">{{$currency}}</option>
                                    @endforeach
                                </select>
                                @error('currency')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="lg:flex">
                            <div class="px-2 py-4 lg:w-1/2">
                                <label for="desc"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-5
                                focus-within:border-blue-600">
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Описание') }}
                                    </span>
                                    <textarea name="desc" id="desc"
                                              class="peer  h-8 w-full overflow-y-auto border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"></textarea>

                                </label>
                                @error('desc')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div x-data="{ imageUrl: '', imageUploaded: false }"
                                 class="flex items-center space-x-6 px-2 py-4 lg:w-1/2">
                                <div class="shrink-0" x-show="imageUploaded">
                                    <img x-bind:src="imageUrl" class="w-20 object-cover rounded"
                                         alt="Current profile photo"/>
                                </div>
                                <label class="block">
                                    <span class="sr-only">{{ __('Выберите логотпи')  }}</span>
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
