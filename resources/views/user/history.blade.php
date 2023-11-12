@extends('layouts.user')

@section('title', 'История')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('История операций') }}</h3>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Дата')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Магазин')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Доход')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Росход')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('Статус')  }}
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('ID')  }}
                            </th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        @foreach($operations as $operation)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $operation->created_at }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $operation->merchant->title }}</div>
                                </td>
                                @if ($operation->type === 'payIn')
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            <span
                                                class="px-3 inline-flex text-xs leading-5 font-semibold text-green-500">
                                                +{{$operation->payment->amount_default_currency}}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            <span
                                                class="px-3 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-600 shadow text-green-100">
                                            </span>
                                        </div>
                                    </td>
                                @endif
                                @if ($operation->type === 'payOut')
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">

                                    </td>
                                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-900">
                                            <span
                                                class="px-3 inline-flex text-sm leading-5 font-semibold  text-red-300">
                                                -{{$operation->withdrawal->amount_default_currency}}
                                            </span>
                                        </div>
                                    </td>
                                @endif
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        @if ($operation->confirmed && isset($operation->payment->approved) || isset($operation->withdrawal->approved))
                                            <span
                                                class="p-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-400 shadow text-green-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                                  <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z"/>
                                                </svg>

                                            </span>
                                        @elseif ($operation->canceled && isset($operation->payment->canceled) || isset($operation->withdrawal->canceled))
                                            <span
                                                class="p-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-300 shadow text-red-100">
                                               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                                  <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>

                                            </span>
                                        @else
                                            <span
                                                class="p-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-sky-300 shadow text-sky-100">
                                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                   stroke-width="1.5" stroke="currentColor" class="w-10 h-10">
                                                  <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/>
                                                </svg>
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">
                                        <a href="{{route('transaction', [$operation->id])}}"
                                           class="px-3 inline-flex text-sm leading-5 font-semibold  text-red-300">
                                            {{$operation->id}}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $operations->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
