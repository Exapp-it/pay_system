@extends('layouts.admin')

@section('title', 'Реквизиты')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Добавление реквизитов') }}
            <span
                class="float-right text-sm font-semibold py-1 px-3 border-2 border-yellow-400 rounded shadow transition duration-300 hover:border-black hover:text-yellow-400">
            <a href="{{ route('admin.ps.info') }}">Назад</a>
        </span>
        </h3>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <form action="{{route('admin.ps.info.store')}}" method="POST">
                    @csrf
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <div class="lg:flex items-center mt-5">
                            <div class="px-2 py-4 lg:w-1/2">
                                <div class="relative">
                                    <input type="text"
                                           name="title"
                                           id="title"
                                           value="{{ old('title') }}"
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
                                           name="value"
                                           id="value"
                                           value="{{ old('value') }}"
                                           class="peer w-full py-2 border-2 border-gold-200 rounded-md focus:ring-1 focus:ring-gold-300 focus:border-gold-300 focus:outline-none placeholder-transparent">
                                    <label for="value"
                                           class="text-neutral-500 text-sm font-semibold  absolute -top-4 left-2 -translate-y-1/2 transition-all peer-placeholder-shown:left-4 peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-neutral-900 peer-focus:-top-4 peer-focus:left-2 peer-focus:text-neutral-600">
                                        {{ __('Реквизиты') }}
                                    </label>
                                </div>
                                @error('value')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="px-2 py-4 w-full lg:w-1/2 inline-flex justify-center items-center gap-4">
                                <label for="ps_id" class="block text-sm font-medium text-gray-900">
                                    {{ __('Платежная система')  }}
                                </label>

                                <select
                                    name="ps_id"
                                    id="ps_id"
                                    class="mt-1.5 w-1/2 rounded-lg border-gray-300 text-gray-700 sm:text-sm"
                                >
                                    <option value="">{{ __('Выберите платежную систему') }}</option>
                                    @foreach($paySystems as $paySystem)
                                        <option value="{{$paySystem->id}}">{{$paySystem->title}}</option>
                                    @endforeach
                                </select>
                                @error('ps_id')
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
