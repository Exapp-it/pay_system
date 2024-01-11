@extends('layouts.admin')

@section('title', 'Кассы')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Кассы') }}</h3>

        {{--        <div class="mt-8">--}}
        {{--            <a href="{{ route("admin.admin_users.create") }}" class="text-indigo-600 hover:text-indigo-900">Добавить</a>--}}
        {{--        </div>--}}

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
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
                                {{ __('Баланс')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Комиссия')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Сумма платежей за сегодня')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Статус')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Модерация')  }}
                            </th>
                            {{--                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>--}}
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        @foreach($merchants as $merchant)
                            <tr>
                                <td class="font-semibold px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <a href="{{ route('admin.merchant.show', $merchant->id) }}">
                                            {{ $merchant->m_id }}
                                        </a>
                                    </div>
                                </td>
                                <td class="font-semibold px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <a href="{{ route('admin.merchant.show', $merchant->id) }}">
                                            {{ $merchant->title }}
                                        </a>
                                    </div>
                                </td>

                                <td class="font-semibold px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <p>
                                            {{ $merchant->balance }}  {{config('payment.default_currency.name')}}
                                        </p>
                                    </div>
                                </td>

                                <td class="font-semibold px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <p>
                                            {{ $merchant->percent }} %
                                        </p>
                                    </div>
                                </td>
                                <td class="font-semibold px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <p>
                                            {{ $merchant->totalTransactions }} {{config('payment.default_currency.name')}}
                                        </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                       <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full shadow
                                            {{ $merchant->activated ? 'bg-yellow-400 text-black' : 'bg-black text-yellow-400' }}">
                                            {{ $merchant->activated ? __('Подключен') : __('Отключен') }}
                                       </span>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                          <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full shadow
                                            {{ $merchant->approved ? 'bg-yellow-400 text-black' : 'bg-black text-yellow-400' }}">
                                            {{ $merchant->approved ? __('Подтвержден') : __('На модерации') }}
                                          </span>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $merchants->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
