<x-jet-form-section submit="updateLocationName">
    <x-slot name="title">
        {{ __('Location Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The Location name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Location Owner Information -->
        <div class="col-span-6">
            <x-jet-label value="{{ __('Location Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $location->owner->profile_photo_url }}" alt="{{ $location->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div>{{ $location->owner->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $location->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Location Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Location Name') }}" />

            <x-jet-input id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model.defer="state.name"
                        :disabled="! Gate::check('update', $location)" />

            <x-jet-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    @if (Gate::check('update', $location))
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    @endif
</x-jet-form-section>
