@extends('layouts.admin')

@section('title', 'Реквизиты')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Реквизиты платежной системы') }}
            - {{$paySystem->title}}</h3>
        <div class="my-8">
            <a href="{{ route("admin.ps.info.create") }}"
               class="bg-yellow-400 hover:bg-black hover:text-yellow-400 text-black font-bold py-2 px-4 rounded transition duration-300">
                {{ __('Добавить реквизит') }}
            </a>
        </div>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Название')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Реквизит')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Статус')  }}
                            </th>

                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        @foreach($paySystem->infos as $psInfo)
                            <tr>

                                <td class="font-semibold px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <a href="{{ route('admin.merchant.show', $psInfo->id) }}">
                                            {{ $psInfo->title }}
                                        </a>
                                    </div>
                                </td>

                                <td class="font-semibold px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <a href="{{ route('admin.merchant.show', $psInfo->value) }}">
                                            {{ $psInfo->value }}
                                        </a>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                       <span class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full shadow
                                            {{ $psInfo->activated ? 'bg-yellow-400 text-black' : 'bg-black text-yellow-400' }}">
                                            {{ $psInfo->activated ? __('Активный') : __('Не активный') }}
                                       </span>
                                    </div>
                                </td>
                                <td></td>
                                <td></td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex text-sm leading-5 text-gray-900">
                                        <form action="{{route('admin.ps.info.change', $psInfo->id)}}" method="POST">
                                            @csrf
                                            <button
                                                class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                                                <span
                                                    class="absolute inset-0 border group-active:border-{{ $psInfo->activated ? 'red-500' : 'lime-500' }}"></span>
                                                <span
                                                    class="block border bg-{{ $psInfo->activated ? 'red-600' : 'lime-600' }} px-2 py-1 transition-transform active:bg-{{ $psInfo->activated ? 'red-500' : 'lime-500' }} group-hover:-translate-x-1 group-hover:-translate-y-1">
                                                        {{ $psInfo->activated ? __('Выкл') : __('Вкл') }}
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="flex flex-wrap justify-end gap-1 text-sm leading-5 text-gray-900">
                                        <a href="{{route('admin.ps.info.edit', $psInfo->id)}}"
                                           class="group relative inline-block text-sm font-medium text-black cursor-pointer focus:outline-none focus:ring">
                                            <span
                                                class="absolute inset-0 border border-yellow-400 group-active:border-yellow-300"></span>
                                            <span
                                                class="block border border-yellow-400 bg-yellow-400 px-2 py-1 transition-transform active:border-yellow-300 active:bg-yellow-300 group-hover:-translate-x-1 group-hover:-translate-y-1">
                                                {{__('Редактировать')}}
                                            </span>
                                        </a>
                                        <form action="{{route('admin.ps.info.delete', $psInfo->id)}}" method="POST">
                                            @csrf
                                            <button
                                                class="group relative inline-block text-sm font-medium text-white focus:outline-none focus:ring">
                                                <span
                                                    class="absolute inset-0 border group-active:border-red-500 }}"></span>
                                                <span
                                                    class="block border bg-red-600 px-2 py-1 transition-transform active:bg-red-500 group-hover:-translate-x-1 group-hover:-translate-y-1">
                                                        {{ __('Удалить') }}
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--                    {{ $psInfos->links() }}--}}
                </div>
            </div>
        </div>
    </div>
@endsection
