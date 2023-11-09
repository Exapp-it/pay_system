@extends('layouts.app')

@section('title', 'Оплата')

@section('content')
    <div class="container mx-auto px-6 py-8 lg:w-3/4">
        <div class="lg:flex items-center justify-between">
            <h3 class="inline-block text-gray-700 text-2xl border-b-2 border-gold-300 font-medium">{{ __('Оплата счета') }}</h3>
            <p class="text-sm mt-3"> Вам предъявлен счет на оплату от
                <a href="{{$shop->base_url}}" class="font-semibold text-gold-400" target="_blank">{{$shop->title}}</a>
            </p>
        </div>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gold-200">
                    <div class="flow-root rounded-lg border border-gold-100 py-3 shadow-sm">
                        <dl class="-my-3 divide-y divide-gray-100 text-sm">
                            <div
                                class="grid grid-cols-1 gap-1 p-3 even:bg-gold-50 sm:grid-cols-3 sm:gap-4"
                            >
                                <dt class="font-medium text-gray-900">{{__('Получатель')}}</dt>
                                <dd class="text-gray-700 text-right sm:col-span-2">{{$shop->base_url}}</dd>
                            </div>

                            <div
                                class="grid grid-cols-1 gap-1 p-3 even:bg-gold-50 sm:grid-cols-3 sm:gap-4"
                            >
                                <dt class="font-medium text-gray-900">{{__('Счет')}}</dt>
                                <dd class="text-gray-700 text-right sm:col-span-2">{{$data->order}}</dd>
                            </div>

                            <div
                                class="grid grid-cols-1 gap-1 p-3 even:bg-gold-50 sm:grid-cols-3 sm:gap-4"
                            >
                                <dt class="font-medium text-gray-900">{{__('Валюта')}}</dt>
                                <dd class="text-gray-700 text-right sm:col-span-2">{{ __($data->currency) }}</dd>
                            </div>

                            <div
                                class="grid grid-cols-1 gap-1 text-xl p-3 even:bg-gold-50 sm:grid-cols-3 sm:gap-4"
                            >
                                <dt class="font-medium text-gray-900">{{__('Сумма')}}</dt>
                                <dd class="text-gray-700 text-right sm:col-span-2">{{$data->amount}}</dd>
                            </div>

                        </dl>
                    </div>

                </div>
                <div class="">
                    <h3 class="text-gray-700 text-xl my-5 font-medium">{{ __('Выберите платежную систему') }}</h3>
                    <form method="POST" action="{{route('api.pay')}}">
                        @csrf
                        <div class="flex flex-wrap justify-between items-center gap-4">
                            @foreach($paymentSystems as $paymentSystem)
                                <label class="cursor-pointer">
                                    <input
                                        type="radio"
                                        class="peer sr-only"
                                        name="payment_system"
                                        value="{{$paymentSystem->id}}"/>
                                    <div
                                        class="w-52 max-w-xl rounded-md bg-white p-5 text-gray-600 ring-gold-100 ring-2 ring-transparent transition-all hover:shadow peer-checked:text-gold-600 peer-checked:ring-gold-400 peer-checked:ring-offset-2">
                                        <div class="flex flex-col gap-1">
                                            <div class="flex items-center justify-between">
                                                <p class="text-sm font-semibold uppercase text-gray-500">{{$paymentSystem->title}}</p>
                                                <div>
                                                    <svg width="24" height="24" viewBox="0 0 24 24">
                                                        <path fill="currentColor"
                                                              d="m10.6 13.8l-2.175-2.175q-.275-.275-.675-.275t-.7.3q-.275.275-.275.7q0 .425.275.7L9.9 15.9q.275.275.7.275q.425 0 .7-.275l5.675-5.675q.275-.275.275-.675t-.3-.7q-.275-.275-.7-.275q-.425 0-.7.275ZM12 22q-2.075 0-3.9-.788q-1.825-.787-3.175-2.137q-1.35-1.35-2.137-3.175Q2 14.075 2 12t.788-3.9q.787-1.825 2.137-3.175q1.35-1.35 3.175-2.138Q9.925 2 12 2t3.9.787q1.825.788 3.175 2.138q1.35 1.35 2.137 3.175Q22 9.925 22 12t-.788 3.9q-.787 1.825-2.137 3.175q-1.35 1.35-3.175 2.137Q14.075 22 12 22Z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="flex">
                                                <img src="{{ asset('storage/' . $paymentSystem->logo) }}"
                                                     alt="{{ $paymentSystem->title }}"
                                                     class="w-16 rounded">
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                                @error('payment_system')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                        </div>
                        <div class="mt-4">
                            <button type="submit"
                                    class="group float-right relative inline-block overflow-hidden border border-yellow-400 px-8 py-3 focus:outline-none focus:ring">
                                <span
                                    class="absolute inset-y-0 left-0 w-[2px] bg-yellow-400 transition-all group-hover:w-full group-active:bg-yellow-400"></span>
                                <span
                                    class="relative text-sm font-medium text-black transition-colors group-hover:text-black">
                                            {{ __('Продолжить')  }}
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
