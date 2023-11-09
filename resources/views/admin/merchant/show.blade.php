@extends('layouts.admin')

@section('title', 'Кассы')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Касса - ' . $merchant->m_id) }}
            <span
                class="float-right text-sm font-semibold py-1 px-3 border-2 border-yellow-400 rounded shadow transition duration-300 hover:border-black hover:text-yellow-400">
            <a href="{{ route('admin.merchant')  }}">Назад</a>
        </span>
        </h3>
        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <div class="lg:flex">
                        <div class="px-2 py-4 lg:w-1/3">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text" value="{{ $merchant->title }}" disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Название') }}
                                </span>
                            </label>
                        </div>

                        <div class="px-2 py-4 lg:w-1/3">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text" value="{{ $merchant->base_url  }}" disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Домен') }}
                                </span>
                            </label>
                        </div>

                        <div class="px-2 py-4 lg:w-1/3">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text" value="{{ $merchant->m_id  }}" disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('ID') }}
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="lg:flex">
                        <div class="px-2 py-4 lg:w-1/3">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text" value="{{ $merchant->success_url  }}" disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('URL успешной оплаты') }}
                                </span>
                            </label>
                        </div>

                        <div class="px-2 py-4 lg:w-1/3">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text" value="{{ $merchant->fail_url  }}" disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('URL неуспешной оплаты') }}
                                </span>
                            </label>
                        </div>

                        <div class="px-2 py-4 lg:w-1/3">
                            <label
                                class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                <input type="text" value="{{ $merchant->handler_url  }}" disabled
                                       class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                <span
                                    class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('URL обработчика') }}
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="lg:flex">
                        <div class="px-2 py-4 lg:w-1/3">
                            <form action="{{route('admin.merchant.percent', $merchant->id)}}" method="POST">
                                @csrf
                                <label for="percent"
                                       class="relative block overflow-hidden border-b border-gray-200 bg-transparent pt-3 focus-within:border-blue-600">
                                    <input type="text" name="percent" id="percent" value="{{ $merchant->percent  }}"
                                           class="peer h-8 w-full border-none bg-transparent p-0 placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0 sm:text-sm"/>
                                    <span
                                        class="absolute start-0 top-2 -translate-y-1/2 text-xs text-gray-700 transition-all peer-placeholder-shown:top-1/2 peer-placeholder-shown:text-sm peer-focus:top-2 peer-focus:text-xs">
                                    {{ __('Установить индивидуальную комиссию') }}
                                </span>
                                    <button type="submit"
                                            class="absolute right-2 top-2 cursor-pointer text-yellow-400 hover:underline">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zm-7.518-.267A8.25 8.25 0 1120.25 10.5M8.288 14.212A5.25 5.25 0 1117.25 10.5"/>
                                        </svg>

                                    </button>
                                </label>
                                @error('percent')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </form>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        @if ($merchant->approved)
                            <div class="px-2 py-4">
                                <form
                                    action="{{ $merchant->banned ? route("admin.merchant.unlock", $merchant->id) : route("admin.merchant.block", $merchant->id) }}"
                                    method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="group relative inline-block overflow-hidden border border-yellow-400 px-8 py-3 focus:outline-none focus:ring">
                                        <span
                                            class="absolute inset-y-0 left-0 w-[2px] bg-yellow-400 transition-all group-hover:w-full group-active:bg-yellow-400"></span>
                                        <span
                                            class="relative text-sm font-medium text-black transition-colors group-hover:text-black">
                                            {{ $merchant->banned ? __('Разблокировать') : __('Заблокировать') }}
                                        </span>
                                    </button>

                                </form>

                            </div>
                        @else
                            <div class="px-2 py-4">
                                <form action="{{ route("admin.merchant.approve", $merchant->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="group relative inline-block overflow-hidden border border-yellow-400 px-8 py-3 focus:outline-none focus:ring">
                                        <span
                                            class="absolute inset-y-0 left-0 w-[2px] bg-yellow-400 transition-all group-hover:w-full group-active:bg-yellow-400"></span>
                                        <span
                                            class="relative text-sm font-medium text-black  transition-colors group-hover:text-black">
                                            {{ __('Одобрить')  }}
                                        </span>
                                    </button>
                                </form>
                            </div>
                            <div class="px-2 py-4">
                                <form action="{{ route("admin.merchant.reject", $merchant->id) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="group relative inline-block overflow-hidden border border-red-500 px-8 py-3 focus:outline-none focus:ring">
                                        <span
                                            class="absolute inset-y-0 left-0 w-[2px] bg-red-500 transition-all group-hover:w-full group-active:bg-red-500"></span>
                                        <span
                                            class="relative text-sm font-medium text-black  transition-colors group-hover:text-black">
                                            {{ __('Отказать')  }}
                                        </span>
                                    </button>
                                </form>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
