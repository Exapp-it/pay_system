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
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        @if ($merchant->is_active)
                                            <span
                                                class="px-3  inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-400 shadow text-black">
                                                {{ __('Подключен')  }}
                                            </span>
                                        @else
                                            <span
                                                class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-black shadow text-yellow-400">
                                                {{ __('Отключен')  }}
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        @if ($merchant->moderation)
                                            <span
                                                class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-400 shadow text-black">
                                                {{ __('Подтвержден')  }}
                                            </span>
                                        @else
                                            <span
                                                class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-black shadow text-yellow-400">
                                                {{ __('На модерации')  }}
                                            </span>
                                        @endif
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
