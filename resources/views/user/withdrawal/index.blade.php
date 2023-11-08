@extends('layouts.user')

@section('title', 'Мои магазины')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Список магазин')  }}</h3>

        <div class="my-8">
            <a href="{{ route("merchant.create") }}"
               class="bg-gold-300 hover:bg-black hover:text-gold-300 text-black font-bold py-2 px-4 rounded transition duration-300">
                {{ __('Подключить магазин') }}
            </a>
        </div>


        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    @isset($merchants)
                        <table class="min-w-full">
                            <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('ID')  }}
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Название')  }}
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Статус')  }}
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    {{ __('Модерация')  }}
                                </th>
                            </tr>
                            </thead>

                            <tbody class="bg-white">
                            @foreach($merchants as $merchant)
                                <tr>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm font-semibold leading-5 text-gray-900">
                                            <a href="{{ route("merchant.show", $merchant->id) }}">
                                                {{ $merchant->m_id }}
                                            </a>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">{{ $merchant->title }}</div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full shadow
                                                {{ $merchant->activated ? 'bg-gold-300 text-black' : 'bg-black text-gold-300' }}">
                                                {{ $merchant->activated ? __('Подключен') : __('Отключен') }}
                                            </span>
                                        </div>
                                    </td>


                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                          <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full shadow
                                            {{ $merchant->approved ? 'bg-gold-300 text-black' : 'bg-black text-gold-300' }}">
                                            {{ $merchant->approved && !$merchant->rejected ? __('Подтвержден') : __('На модерации') }}
                                          </span>
                                        </div>
                                    </td>

                                    @if($merchant->banned || $merchant->rejected)
                                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-900">
                                          <span
                                              class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full shadow bg-red-600 text-white">
                                              {{ $merchant->rejected ? __('Отказано') : __('Заблокировано') }}
                                          </span>
                                            </div>
                                        </td>
                                    @endif

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endisset

                    @empty($merchant)
                        <div class="flex justify-center">
                            <span
                                class="text-xl text-red-600 font-semibold p-6">{{__('У вас нет подключенных магазинов на данный момент')}}</span>
                        </div>
                    @endempty
                    {{ $merchants->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
