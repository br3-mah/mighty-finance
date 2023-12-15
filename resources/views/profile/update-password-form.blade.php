<x-jet-form-section class=" profile-card card-bx pt-4" submit="updatePassword">
    <div class="">
        <x-slot name="title">
            {{ __('Update Password') }}
        </x-slot>
    
        <x-slot name="description">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </x-slot>
    </div>

    <x-slot name="form">
        <div class="row">
            <div class="col-sm-6 m-b30">
                <x-jet-label for="current_password" value="{{ __('Current Password') }}" />
                <x-jet-input id="current_password" type="password" class="mt-1 block w-full form-control input-default" wire:model.defer="state.current_password" autocomplete="current-password" />
                <x-jet-input-error for="current_password" class="mt-2" />
            </div>
    
            <div class="col-sm-6 m-b30">
                <x-jet-label for="password" value="{{ __('New Password') }}" />
                <x-jet-input id="password" type="password" class="mt-1 block w-full form-control input-default" wire:model.defer="state.password" autocomplete="new-password" />
                <x-jet-input-error for="password" class="mt-2" />
            </div>
    
            <div class="col-sm-6 m-b30">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full form-control input-default" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
                <x-jet-input-error for="password_confirmation" class="mt-2" />
            </div>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button class="btn  btn-square btn-primary">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
