@extends('layouts.admin')

@section('title', 'Платежные системы')


@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Добавление платежной системы') }}
            <span
                class="float-right text-sm font-semibold py-1 px-3 border-2 border-yellow-400 rounded shadow transition duration-300 hover:border-black hover:text-yellow-400">
            <a href="{{ route('admin.ps.info') }}">Назад</a>
        </span>
        </h3>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <form action="{{route('admin.ps.info.update', $psInfo->id)}}" method="POST">
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
                                           value="{{ $psInfo->title }}"
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
                                <label for="value"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text"
                                           name="value"
                                           id="value"
                                           value="{{ $psInfo->value }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Реквизит')  }}
                                    </span>
                                </label>
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
                                    id="ps_id"
                                    class="mt-1.5 w-1/2 rounded-lg border-gray-300 text-gray-700 sm:text-sm"
                                    disabled
                                >
                                    <option value="">{{ $psInfo->paymentSystem->title  }}</option>

                                </select>
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
