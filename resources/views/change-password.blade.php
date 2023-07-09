<x-auth-layout>
    <h2 class="mb-4 text-center text-lg font-bold leading-9 tracking-tight text-gray-900">
        {{ __('Please change your password before continuing.') }}
    </h2>
    <form method="POST" action="{{ route('password.change') }}">
        @csrf

        <!-- Current Password -->
        <div>
            <x-input-label for="current_password" :value="__('Current Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="current_password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
        </div>

        <!-- New Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          type="password"
                          name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-auth-layout>