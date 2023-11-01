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
                                                <x-input-label for="title" :value="__('Название кассы')" />
                                                <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" />
                                                <x-input-error class="mt-2" :messages="$errors->get('title')" />
                                            </div>
                                            <div>
                                                <x-input-label for="base_url" :value="__('URL Сайта')" />
                                                <x-text-input id="base_url" name="base_url" type="text" class="mt-1 block" />
                                                <x-input-error class="mt-2" :messages="$errors->get('base_url')" />
                                            </div>
                                            <div>
                                                <x-input-label for="success_url" :value="__('URL Сайта')" />
                                                <x-text-input id="success_url" name="success_url" type="text" class="mt-1 block" />
                                                <x-input-error class="mt-2" :messages="$errors->get('success_url')" />
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