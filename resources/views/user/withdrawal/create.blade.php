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
                <form action="{{route('user.withdrawal.store')}}" method="POST">
                    @csrf
                    <div
                        class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                        <div class="lg:flex">
                            <div class="px-2 py-4 lg:w-1/2">
                                <label for="amount"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text"
                                           name="amount"
                                           id="amount"
                                           value="{{ old('amount') }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Введите сумму') }}
                                    </span>
                                </label>

                                @error('amount')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-2 py-4">
                                <label for="m_id" class="block text-sm font-medium text-gray-900">
                                    {{ __('Баланс')  }}
                                </label>

                                <select
                                    name="m_id"
                                    id="m_id"
                                    class="rounded-lg border-gray-300 text-gray-700 sm:text-sm"
                                >
                                    <option value="">{{ __('Выберите баланс') }}</option>
                                    @foreach($merchants as $merchant)
                                        <option value="{{$merchant->id}}">{{$merchant->balance}} ({{$merchant->title}}
                                            )
                                        </option>
                                    @endforeach
                                </select>
                                @error('m_id')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="lg:flex">
                            <div class="px-2 py-4 lg:w-1/2">
                                <label for="details"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text"
                                           name="details"
                                           id="details"
                                           value="{{ old('details') }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Реквизиты') }}
                                    </span>
                                </label>

                                @error('amount')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-2 py-4">
                                <label for="ps_id" class="block text-sm font-medium text-gray-900">
                                    {{ __('Платежная система')  }}
                                </label>

                                <select
                                    name="ps_id"
                                    id="ps_id"
                                    class="rounded-lg border-gray-300 text-gray-700 sm:text-sm"
                                >
                                    <option value="">{{ __('Выберите платежную систему') }}</option>
                                    @foreach($paymentSystems as $paymentSystem)
                                        <option value="{{$paymentSystem->id}}">
                                            {{$paymentSystem->title}} ({{$paymentSystem->currency}} )
                                        </option>
                                    @endforeach
                                </select>
                                @error('ps_id')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        @if(session('message'))
                            <div class="flex justify-center">
                                <div class="bg-red-500 text-white p-4 rounded-lg shadow">
                                    {{ session('message') }}
                                </div>
                            </div>
                        @elseif(session('success'))
                            <div class="flex justify-center">
                                <div class="bg-lime-600 text-white p-4 rounded-lg shadow">
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        <div class="flex justify-center">
                            <div class="px-2 py-4">
                                <button type="submit"
                                        class="group relative inline-block overflow-hidden border border-yellow-400 px-8 py-3 focus:outline-none focus:ring">
                                        <span
                                            class="absolute inset-y-0 left-0 w-[2px] bg-yellow-400 transition-all group-hover:w-full group-active:bg-yellow-400"></span>
                                    <span
                                        class="relative text-sm font-medium text-black  transition-colors group-hover:text-black">
                                            {{ __('Подтвердить')  }}
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
