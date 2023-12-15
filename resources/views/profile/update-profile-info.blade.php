<div class="card profile-card card-bx pt-4" submit="updateProfileInformation">
    {{-- <div style="background-color: rgb(81, 10, 139)" class=" font-w500 card-header">
        <x-slot name="title">
            {{ __('Basic Info') }}
        </x-slot>
        <x-slot name="description">
            {{ __('Update your account\'s profile information and email address.') }}
        </x-slot>
    </div> --}}

    <div>
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                {{-- <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" /> --}}
            </div>
        @endif

        <div class="row">
            <!-- Name -->
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="fname" value="{{ __('First Name') }}" />
                <x-jet-input id="fname" type="text" class="form-control" wire:model.defer="state.fname" autocomplete="fname" />
                <x-jet-input-error for="fname" class="mt-2" />
            </div>
            <!-- Name -->
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="lname" value="{{ __('Last Name') }}" />
                <x-jet-input id="lname" type="text" class="form-control" wire:model.defer="state.lname" autocomplete="lname" />
                <x-jet-input-error for="lname" class="mt-2" />
            </div>

            <!-- Email -->
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" type="email" disabled class="form-control" wire:model.defer="state.email" />
                <x-jet-input-error for="email" class="mt-2" />
            </div>    

            <!-- phone -->
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                <x-jet-input id="phone" type="text" class="form-control" wire:model.defer="state.phone" />
                <x-jet-input-error for="phone" class="mt-2" />
            </div>
            
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="id_type" value="{{ __('ID Type') }}" />
                <select id="id_type" type="text" class="form-control" wire:model.defer="state.id_type">
                    <option value="">-- Choose --</option>
                    <option value="NRC">NRC</option>
                    <option value="Passport">Passport</option>
                    <option value="Driver Liecense">Driver Liecense</option>
                </select>
                <x-jet-input-error for="address" class="mt-2" />
            </div> 

            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="nrc_no" value="{{ __('ID Number') }}" />
                <x-jet-input id="nrc_no" type="text" class="form-control" wire:model.defer="state.nrc_no" />
                <x-jet-input-error for="nrc_no" class="mt-2" />
            </div> 

            <!-- phone -->
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="occupation" value="{{ __('Occupation') }}" />
                <x-jet-input id="occupation" type="text" class="form-control" wire:model.defer="state.occupation" />
                <x-jet-input-error for="occupation" class="mt-2" />
            </div>
            <!-- phone -->
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="basic_pay" value="{{ __('Basic Pay') }} (ZMW)" />
                <x-jet-input id="basic_pay" type="text" class="form-control" wire:model.defer="state.basic_pay" />
                <x-jet-input-error for="basic_pay" class="mt-2" />
            </div>
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="net_pay" value="{{ __('Net Pay') }} (ZMW)" />
                <x-jet-input id="net_pay" type="text" class="form-control" wire:model.defer="state.net_pay" />
                <x-jet-input-error for="net_pay" class="mt-2" />
            </div>
            <!-- phone -->
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="address" value="{{ __('Address') }}" />
                <x-jet-input id="address" type="text" class="form-control" wire:model.defer="state.address" />
                <x-jet-input-error for="address" class="mt-2" />
            </div>
            <!-- phone -->
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="dob" value="{{ __('Date of Birth') }}" />
                <x-jet-input name="datepicker" id="datepicker" type="text" class="form-control" placeholder="yyyy-mm-dd" wire:model.defer="state.dob" />
                <x-jet-input-error for="dob" class="mt-2" />
            </div>
            <!-- phone -->
            <div class="col-sm-6 mt-3 m-b30">
                <x-jet-label for="gender" value="{{ __('Gender') }}" />
                <select id="gender" type="text" class="form-control" wire:model.defer="state.gender">
                    <option value="">-- Choose --</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <x-jet-input-error for="address" class="mt-2" />
            </div>
            
        </div>
    </div>

    {{-- <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Updating...') }}
        </x-jet-action-message>
        <br>
        <x-jet-button wire:loading.attr="disabled" type="submit"  class="btn  btn-square btn-primary" wire:target="photo">
            {{ __('Save Changes') }}
        </x-jet-button>
    </x-slot> --}}
</div>
