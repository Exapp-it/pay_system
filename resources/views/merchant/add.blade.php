<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="py-12">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl">
                                    <section>
                                        <header>
                                            <h2 class="text-lg font-medium text-gray-900">
                                                {{ __('Создать кассу') }}
                                            </h2>
                                        </header>
                                        <form method="post" action="{{ route('merchant.store') }}" class="mt-6 space-y-6">
                                            @csrf
                                            <div>
                                                <x-input-label for="title" :value="__('Название кассы:')" />
                                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="My Project" :value="old('title')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                            </div>
                                            <div>
                                                <x-input-label for="base_url" :value="__('Домен:')" />
                                                <x-text-input id="base_url" name="base_url" type="text" class="mt-1 block w-full" placeholder="https://ваш.сайт" :value="old('base_url')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('base_url')" />
                                                <small class="text-gray-500">{{ __('Домен должен использовать протокол HTTPS') }}</small>
                                            </div>


                                            <div>
                                                <x-input-label for="success_url" :value="__('URL успешной оплаты:')" />
                                                <x-text-input id="success_url" name="success_url" type="text" class="mt-1 block w-full" placeholder="https://ваш.сайт/success" :value="old('success_url')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('success_url')" />
                                            </div>

                                            <div>
                                                <x-input-label for="fail_url" :value="__('URL неуспешной оплаты:')" />
                                                <x-text-input id="fail_url" name="fail_url" type="text" class="mt-1 block w-full" placeholder="https://ваш.сайт/fail" :value="old('fail_url')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('fail_url')" />
                                            </div>

                                            <div>
                                                <x-input-label for="handler_url" :value="__('URL обработчика:')" />
                                                <x-text-input id="handler_url" name="handler_url" type="text" class="mt-1 block w-full" placeholder="https://ваш.сайт/handler" :value="old('handler_url')" />
                                                <x-input-error class="mt-2" :messages="$errors->get('handler_url')" />
                                            </div>

                                            <div class="flex items-center gap-4">
                                                <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

                                                <!-- @if (session('status') === 'profile-updated')
                                                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">{{ __('Сохранено.') }}</p>
                                                @endif -->
                                            </div>
                                        </form>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>