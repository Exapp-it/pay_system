<x-guest-layout>
    <x-input-error :messages="$errors->get('error')" class="mx-2"/>

    <form method="POST" action="{{ route('admin.login.store') }}">
        @csrf

        <div>
            <x-input-label for="username" :value="__('Логин')"/>
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')"
                          autofocus/>
            <x-input-error :messages="$errors->get('username')" class="mt-2"/>
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          autocomplete="current-password"/>

            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Войти') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
