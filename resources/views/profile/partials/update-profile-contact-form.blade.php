<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Контактная информация') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Обновление контактной информации.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update.contact') }}" class="mt-6 space-y-6">
        @csrf

        <div>
            <x-input-label for="telegram" :value="__('Telegram')" />
            <x-text-input id="telegram" name="telegram" type="text" class="mt-1 block w-full" :value="old('telegram', $user->telegram)" autofocus autocomplete="telegram" />
            <x-input-error class="mt-2" :messages="$errors->get('telegram')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Сохранить') }}</x-primary-button>

            @if (session('status') === 'contact-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-green-600">{{ __('Сохранено.') }}</p>
            @endif
        </div>
    </form>
</section>