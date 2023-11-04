<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
<div>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false"
             class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
             class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-black overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <img class="w-40" src="https://www.amug.com/wp-content/uploads/2016/09/you-logo-here.png"
                         alt="Laravel Logo">
                </div>

            </div>

            <nav class="mt-10">
                <div x-data="{ currentRoute: '{{ request()->route()->getName() }}' }">

                    <a href="{{ route('dashboard') }}"
                       class="text-yellow-400 m-5 font-semibold flex items-center mt-4 py-2 px-6 transition duration-300 rounded-md hover:bg-yellow-400  hover:text-black hover:shadow-md"
                       x-bind:class="{'active': currentRoute === 'dashboard'}">
                        <span class="mx-3">Главная</span>
                    </a>

                    <a href="{{ route('merchant') }}"
                       class="text-yellow-400 m-5 font-semibold flex items-center mt-4 py-2 px-6 transition duration-300 rounded-md hover:bg-yellow-400  hover:text-black hover:shadow-md"
                       x-bind:class="{'active': currentRoute === 'merchant'}">
                        <span class="mx-3">{{ __('Мои кассы')  }}</span>
                    </a>

                    <a href="#"
                       class="text-yellow-400 m-5 font-semibold flex items-center mt-4 py-2 px-6 transition duration-300 rounded-md hover:bg-yellow-400  hover:text-black hover:shadow-md"
                       x-bind:class="{'active': currentRoute === ''}">
                        <span class="mx-3">Кассы</span>
                    </a>

                    <a href="#"
                       class="text-yellow-400 m-5 font-semibold flex items-center mt-4 py-2 px-6 transition duration-300 rounded-md hover:bg-yellow-400  hover:text-black hover:shadow-md"
                       x-bind:class="{'active': currentRoute === ''}">
                        <span class="mx-3">Настройки</span>
                    </a>



                </div>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center py-4 px-6 shadow-2xl bg-gray-50 border-b-2 border-yellow-400">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>

                <div class="flex items-center">
                    <div x-data="{ dropdownOpen: false }" class="relative">
                        <button @click="dropdownOpen = ! dropdownOpen"
                                class="relative block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                            <img class="h-full w-full object-cover"
                                 src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=296&amp;q=80"
                                 alt="Your avatar">
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false"
                             class="fixed inset-0 h-full w-full z-10"
                             style="display: none;"></div>

                        <div x-show="dropdownOpen"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md overflow-hidden shadow-xl z-10"
                             style="display: none;">
                            <a href="{{ route("logout") }}"
                               class="block px-4 py-2 text-sm text-gray-700 hover:bg-yellow-400">Выйти</a>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                @yield('content')
            </main>
        </div>
    </div>
</div>
</body>
</html>
