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
                                                {{ __('Касса')  . ' - ' . $merchant->title }}
                                            </h2>
                                        </header>
                                        <hr>
                                        <div class="flex gap-8">
                                            <p>
                                                <b>
                                                    {{__('Название: ')}}
                                                </b>
                                                {{ $merchant->title }}
                                            </p>
                                            <p>
                                                <b>
                                                    {{__('Домен: ')}}
                                                </b>
                                                {{ $merchant->base_url }}
                                            </p>
                                            <p>
                                                <b>
                                                    {{__('ID: ')}}
                                                </b>
                                                {{ $merchant->m_id }}
                                            </p>
                                            <p>
                                                <b>
                                                    {{__('Ключ: ')}}
                                                </b>
                                                {{ $merchant->m_key }}
                                            </p>
                                            <p>
                                                <b>
                                                    {{__('Статус: ')}}
                                                </b>
                                                @if($merchant->approved)
                                                {{ __('Подтвержден') }}
                                                @else
                                                {{ __('На модерации') }}
                                                @endif
                                            </p>
                                        </div>
                                        <hr>
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
