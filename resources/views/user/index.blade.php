@extends('layouts.user')

@section('title', 'Личный кабинет')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex-col space-y-20">
            <div class="grid gap-4 lg:gap-8 md:grid-cols-2">
                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">
                            <span>{{__('Пользлватели')}}</span>
                        </div>

                        <div class="text-3xl">
                            {{$statistics->usersCount}}
                            <span class="text-xl font-semibold float-right">{{__('Чел.')}}</span>
                        </div>

                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">

                            <span>+ {{$statistics->usersCountToday}} {{__('Сегодня')}}</span>

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">
                            <span>{{__('Магазины')}}</span>
                        </div>

                        <div class="text-3xl">
                            {{$statistics->merchantsCount}}
                            <span class="text-xl font-semibold float-right">{{__('Шт.')}}</span>
                        </div>

                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">

                            <span>+ {{$statistics->merchantsCountToday}} {{__('Сегодня')}}</span>

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>

                </div>

                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">

                            <span>{{__('Платежи')}}</span>
                        </div>

                        <div class="text-3xl">
                            {{moneyFormat($statistics->approvedPaymentsSum)}}
                            <span
                                class="text-xl font-semibold float-right">{{config('payment.default_currency.name')}}</span>
                        </div>


                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">

                            <span>+ {{moneyFormat($statistics->approvedPaymentsSumToday)}} {{__('Сегодня')}}</span>

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="relative p-6 rounded-2xl bg-white shadow dark:bg-gray-800">
                    <div class="space-y-2">
                        <div
                            class="flex items-center space-x-2 rtl:space-x-reverse text-sm font-medium text-gray-500 dark:text-gray-200">

                            <span>{{__('Выплаты')}}</span>
                        </div>

                        <div class="text-3xl">
                            {{moneyFormat($statistics->approvedWithdrawalsSum)}}
                            <span
                                class="text-xl font-semibold float-right">{{config('payment.default_currency.name')}}</span>
                        </div>

                        <div class="flex items-center space-x-1 rtl:space-x-reverse text-sm font-medium text-green-600">

                            <span>+ {{moneyFormat($statistics->approvedWithdrawalsSumToday)}} {{__('Сегодня')}}</span>

                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                 fill="currentColor"
                                 aria-hidden="true">
                                <path fill-rule="evenodd"
                                      d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                      clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    </div>
                </div>

            </div>
            <div class="grid justify-center gap-4 lg:gap-8 md:grid-cols-4">
                <div class="w-fit rounded-[25px] bg-white p-8 aspect">
                    <div class="h-12">
                        <svg class="h-full fill-white stroke-lime-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3"/>
                        </svg>

                    </div>
                    <div class="my-2">
                        <h2 class="text-4xl font-bold">
                            <span>{{moneyFormat($statistics->approvedPaymentsSumLast7Days)}}</span>
                            <span
                                class="text-xl font-semibold float-right">{{config('payment.default_currency.name')}}</span>
                        </h2>
                    </div>

                    <div>
                        <p class="mt-2 font-sans text-base font-medium text-gray-500">{{__('Сумма платежей за последние 7 дней')}}</p>
                    </div>
                </div>
                <div class="w-fit rounded-[25px] bg-white p-8 aspect">
                    <div class="h-12">
                        <svg class="h-full fill-white stroke-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"/>
                        </svg>

                    </div>
                    <div class="my-2">
                        <h2 class="text-4xl font-bold">
                            <span>{{moneyFormat($statistics->approvedWithdrawalsSumLast7Days)}}</span>
                            <span
                                class="text-xl font-semibold float-right">{{config('payment.default_currency.name')}}</span>
                        </h2>
                    </div>

                    <div>
                        <p class="mt-2 font-sans text-base font-medium text-gray-500">{{__('Сумма выплат за последние 7 дней')}}</p>
                    </div>
                </div>
                <div class="w-fit rounded-[25px] bg-white p-8 aspect">
                    <div class="h-12">
                        <svg class="h-full fill-white stroke-lime-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3"/>
                        </svg>
                    </div>
                    <div class="my-2">
                        <h2 class="text-4xl font-bold">
                            <span>{{moneyFormat($statistics->approvedPaymentsSumThisMonth)}}</span>
                            <span
                                class="text-xl font-semibold float-right">{{config('payment.default_currency.name')}}</span>
                        </h2>
                    </div>

                    <div>
                        <p class="mt-2 font-sans text-base font-medium text-gray-500">{{__('Сумма платежей за текущий месяц')}}</p>
                    </div>
                </div>
                <div class="w-fit rounded-[25px] bg-white p-8 aspect">
                    <div class="h-12">
                        <svg class="h-full fill-white stroke-red-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18"/>
                        </svg>
                    </div>
                    <div class="my-2">
                        <h2 class="text-4xl font-bold">
                            <span>{{moneyFormat($statistics->approvedWithdrawalsSumThisMonth)}}</span>
                            <span
                                class="text-xl font-semibold float-right">{{config('payment.default_currency.name')}}</span>
                        </h2>
                    </div>

                    <div>
                        <p class="mt-2 font-sans text-base font-medium text-gray-500">{{__('Сумма выплат за текущий месяц')}}</p>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
