@extends('layouts.app')

@section('title', 'Оплата')

@section('content')
    <div class="container mx-auto px-6 py-8 lg:w-3/4" xmlns:x-bind="http://www.w3.org/1999/xhtml"
         xmlns:x-on="http://www.w3.org/1999/xhtml">
        <div class="lg:flex items-center justify-between">
            <h3 class="inline-block text-gray-700 text-2xl border-b-2 border-gold-300 font-medium">{{ __('Оплата счета') }}</h3>
        </div>

        <div class="p-4 max-w-xl mx-auto">

            <div x-data="$store.timer" x-init="() => $store.timer.startTimer()"
                 class="text-center border border-gold-50 px-5 py-6 my-5 rounded-lg shadow-xl">
                <p class="text-sm font-semibold">
                    {{__('Вы должны совершить перевод в течение')}}
                    <span x-text="$store.timer.formatTime" class="text-gold-400 font-bold"></span>
                    {{__(' минут и указать точную сумму, иначе операция не будет выполнен.')}}
                </p>
                <p class="text-sm text-red-500 mt-2">{{__('Пожалуйста, не закрывайте страницу и не обновляйте её до завершения операции.')}}</p>
            </div>


            <div class="flex">
                <div class="mr-4 flex flex-col items-center">
                    <div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gold-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-6 w-6 text-gold-400">
                                <path d="M12 5l0 14"></path>
                                <path d="M18 13l-6 6"></path>
                                <path d="M6 13l6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="h-full w-px bg-gold-300"></div>
                </div>
                <div class="pt-1 pb-8">
                    <p class="mb-2 text-xl font-bold text-gray-900">{{__('Перевод')}}</p>
                    <p class="text-gray-600">{{__('Вам необходимо выполнить оплату, используя интернет-банк или личный кабинет платежной системы.')}}</p>
                </div>
            </div>


            <div class="flex">
                <div class="mr-4 flex flex-col items-center">
                    <div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gold-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-6 w-6 text-gold-400">
                                <path d="M12 5l0 14"></path>
                                <path d="M18 13l-6 6"></path>
                                <path d="M6 13l6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="h-full w-px bg-gold-300"></div>
                </div>
                <div class="pt-1 pb-8">
                    <p class="mb-2 text-xl font-bold text-gray-900">{{__('Номер счета (кошелька) получателя.')}}</p>
                    <label
                        class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                        <div x-data="{}" class="relative">
                            <input type="text"
                                   value="{{ $details->value }}"
                                   class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 pr-10 sm:text-sm"
                                   readonly
                            />

                            <button @click="$store.copy('{{ $details->value }}')"
                                    class="absolute right-2 top-2 cursor-pointer text-gold-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"/>
                                </svg>

                            </button>
                        </div>
                    </label>
                </div>
            </div>


            <div class="flex">
                <div class="mr-4 flex flex-col items-center">
                    <div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gold-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-6 w-6 text-gold-400">
                                <path d="M12 5l0 14"></path>
                                <path d="M18 13l-6 6"></path>
                                <path d="M6 13l6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="h-full w-px bg-gold-300"></div>
                </div>
                <div class="pt-1 pb-8">
                    <p class="mb-2 text-xl font-bold text-gray-900">{{__('Сумма к оплате')}}</p>
                    <label
                        class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                        <span class="text-sm font-semibold"> {{$payment->currency}}</span>
                        <div x-data="{}" class="relative">
                            <input type="text"
                                   value="{{$payment->amount}}"
                                   class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"
                                   readonly
                            />
                            <button @click="$store.copy('{{ $payment->amount }}')"
                                    class="absolute right-2 top-2 cursor-pointer text-gold-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5a3.375 3.375 0 00-3.375-3.375H9.75"/>
                                </svg>

                            </button>
                        </div>
                    </label>
                    <span
                        class="text-sm text-red-400">{{__('Укажите точную сумму для перевода, иначе он не будет принят.')}}</span>
                </div>
            </div>

            <div class="flex">
                <div class="mr-4 flex flex-col items-center">
                    <div>
                        <div class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gold-500">
                            <svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="h-6 w-6 text-gold-400">
                                <path d="M12 5l0 14"></path>
                                <path d="M18 13l-6 6"></path>
                                <path d="M6 13l6 6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="h-full w-px bg-gold-300"></div>
                </div>
                <div class="pt-1 pb-8">
                    <p class="mb-2 text-xl font-bold text-gray-900">{{__('Пожалуйста, прикрепите квитанцию о переводе.')}}</p>
                    <div x-data="{ image: '', formActive: true, payConfirmed: false}">
                        <form @submit.prevent="uploadImage" x-show="formActive">
                            <div class="flex flex-wrap items-center space-x-6 px-2 py-4">
                                <div class="shrink-0" x-show="image instanceof Blob">
                                    <img x-bind:src="image ? URL.createObjectURL(image) : null"
                                         class="w-36 object-cover rounded"
                                         alt="Order"/>
                                </div>
                                <label class="block">
                                    <input type="file" name="order"
                                           :disabled="!formActive"
                                           x-on:change="image = $event.target.files[0];"
                                           class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-1 file:border-yellow-400 file:text-sm file:font-semibold file:bg-yellow-50 file:text-black hover:file:bg-yellow-400 file:cursor-pointer"
                                           accept="image/*"/>
                                </label>
                                <div class="text-red-500 text-xs mt-2" id="errorMessage"></div>

                            </div>
                            <button type="submit"
                                    :disabled="!formActive"
                                    class="group relative mt-5 inline-block overflow-hidden border border-gold-400 px-8 py-3 focus:outline-none focus:ring">
                                <span
                                    class="absolute inset-y-0 left-0 w-[2px] bg-gold-400 transition-all group-hover:w-full group-active:bg-gold-400"></span>
                                <span
                                    class="relative text-sm font-medium text-black transition-colors group-hover:text-black">
                                    {{ __('Я Оплатил') }}
                                </span>
                            </button>
                        </form>

                        <div class="flex flex-col mt-5 justify-center" x-show="!formActive && !payConfirmed">
                            <img class="w-72 h-auto" src="{{asset('storage/img/loader.gif')}}" alt="">
                            <p class="text-gold-600 font-semibold">{{__('Подождите, пока платеж будет подтвержден...')}}</p>
                        </div>
                        <div class="flex flex-col mt-5 justify-center" x-show="payConfirmed">
                            <p class="text-green-600 font-semibold">{{__('Платеж проведена успешно')}}</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex">
                <div class="mr-4 flex flex-col items-center">
                    <div>
                        <div
                            class="flex h-10 w-10 items-center justify-center rounded-full border-2 border-gold-500 bg-gold-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="h-6 w-6 text-white">
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                    </div>
                </div>
                <div class="pt-1">

                </div>
            </div>
        </div>
    </div>

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function uploadImage() {
            const errorMessageElement = document.getElementById('errorMessage');
            errorMessageElement.textContent = ''


            const formData = new FormData();
            formData.append('order', this.image);

            fetch('{{ route('api.pay.sendOrder', $payment->id) }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
                .then(response => {
                    this.formActive = false;
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            // Если есть поле "order" в errorData, извлекаем сообщение об ошибке
                            if (errorData.order && errorData.order.length > 0) {
                                throw new Error(errorData.order[0]);
                            } else {
                                throw new Error('Произошла ошибка валидации');
                            }
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    // Обработка успешного ответа от сервера
                    console.log(data);
                    setInterval(sendRepeatRequest.bind(this), 30000);
                    // Вы можете здесь выполнить дополнительные действия с данными
                })
                .catch(error => {
                    // Обработка ошибок
                    errorMessageElement.textContent = error.message;
                    this.formActive = true;
                });
        }

        function sendRepeatRequest() {
            fetch('{{ route('api.pay.confirm', $payment->id) }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(errorData => {
                            throw new Error('Произошла ошибка валидации');
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.message === 'Waiting') {
                        console.info('Ожидание подтвердении');
                    } else if (data.message === 'Cancel') {
                        console.log('Платеж отклонен');
                        setTimeout(function () {
                            window.location.href = '{{ route('api.pay.redirect', 'cancel') }}';
                        }, 3000);
                    } else if (data.message === 'Success') {
                        this.payConfirmed = true
                        console.log('Платеж подтвержден');
                        setTimeout(function () {
                            window.location.href = '{{ route('api.pay.redirect', 'approve') }}';
                        }, 1500);
                    }
                })
                .catch(error => {
                    // Обработка ошибок
                    console.log(error)
                });
        }
    </script>

@endsection
