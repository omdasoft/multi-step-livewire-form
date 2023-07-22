<div>
    <div class="row">
        <div class="col-md-10">
            <form wire:submit.prevent="store">
                <div class="row">
                    <div class="col-md-4">
                        <label for="name_ar">Name Ar</label>
                        <input type="text" id="name_ar" class="form-control" wire:model.defer="drProfile.name_ar" {{ $isCompleted ? 'disabled' :
                            '' }}> @error('drProfile.name_ar')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="name_en">Name En</label>
                        <input type="text" id="name_en" class="form-control" wire:model.defer="drProfile.name_en" {{ $isCompleted ? 'disabled' :
                            '' }}> @error('drProfile.name_en')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="gender">Gender</label><br>
                        <input type="radio" class="form-check-input" id="gender" name="gender" value="1" wire:model.defer="drProfile.gender" {{ $isCompleted
                            ? 'disabled' : '' }}> Male
                        <input type="radio" class="form-check-input" id="gender" name="gender" value="0" wire:model.defer="drProfile.gender" {{ $isCompleted
                            ? 'disabled' : '' }}> Female @error('drProfile.gender')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="bairthdate">Birth Date</label>
                        <input type="date" id="bairthdate" class="form-control" wire:model.defer="drProfile.bairthdate" {{ $isCompleted ?
                            'disabled' : '' }}> @error('drProfile.bairthdate')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="birthplace">Birth Place</label>
                        <input type="text" id="birthplace" class="form-control" wire:model.defer="drProfile.birthplace" {{ $isCompleted ?
                            'disabled' : '' }}> @error('drProfile.birthplace')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="nationality">Nationality</label><br>
                        <select class="form-control" id="nationality" wire:model="drProfile.nationality_id" {{ $isCompleted ? 'disabled' : '' }}>
                                    <option value="">Nationality</option>
                                    @foreach ($nationalities as $nationality)
                                        <option value="{{ $nationality->id }}" {{ old('nationalityId') === $nationality->id }}>
                                            {{ $nationality->nationality }}
                                        </option>
                                    @endforeach
                                </select> @error('drProfile.nationality_id')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control" wire:model.defer="drProfile.phone" {{ $isCompleted ? 'disabled' : '' }}>                        @error('drProfile.phone')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="phone_country_code">Phone Country Code</label>
                        <input type="text" id="phone_country_code" class="form-control" wire:model.defer="drProfile.phone_country_code" {{ $isCompleted
                            ? 'disabled' : '' }}> @error('drProfile.phone_country_code')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="passport_no">Passport No</label><br>
                        <input type="text" class="form-control" id="passport_no" wire:model.defer="drProfile.passport_no" {{ $isCompleted ?
                            'disabled' : '' }}> @error('drProfile.passport_no')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="country">Country</label>
                        <select class="form-control" id="country" wire:model="countryId" {{ $isCompleted ? 'disabled' : '' }}>
                                    <option value="">Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name_en }}</option>
                                    @endforeach
                                </select> @error('countryId')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="state">Country</label>
                        <select class="form-control" id="state" wire:model="stateId" {{ $isCompleted ? 'disabled' : '' }}>
                                    <option value="">State</option>
                                    @foreach($states as $state)
                                        <option value="{{ $state->id }}">{{ $state->name_en}}</option>
                                    @endforeach
                                </select> @error('stateId')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="city">City</label>
                        <select class="form-control" id="city" wire:model="cityId" {{ $isCompleted ? 'disabled' : '' }}>
                                    <option value="">City</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->name_en}}</option>
                                    @endforeach
                                </select> @error('cityId')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="address">Address</label>
                        <input type="text" id="address" class="form-control" wire:model.defer="drProfile.address" {{ $isCompleted ? 'disabled' :
                            '' }}> @error('drProfile.address')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="personal_image">Personal Image</label>
                        <input type="file" id="personal_image{{ $iteration }}" class="form-control" wire:model="personalImage" {{ $isCompleted ?
                            'disabled' : '' }}> @if($personalImagePath)
                        <x-modal title="View Personal Image">
                            <x-media path="{{ $personalImagePath }}" downloadable="true" filename="personal_image">
                                @if(!$isCompleted)
                                <button wire:click.prevent="removePersonalImage('{{ $personalImagePath }}')" class="btn btn-danger mt-2"><i class="fa fa-close"></i> Delete</button>                                @endif
                            </x-media>
                        </x-modal>
                        @endif @error('personalImage')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="passport_copy">Passport Copy</label>
                        <input type="file" id="passport_copy{{ $iteration }}" class="form-control" wire:model="passportCopy" {{ $isCompleted ?
                            'disabled' : '' }}> @if($passportCopyPath)
                        <x-modal title="View Passport Copy Image">
                            <x-media path="{{ $passportCopyPath }}" downloadable="true" filename="passport_copy">
                                @if(!$isCompleted)
                                <button wire:click.prevent="removePassportCopy('{{ $passportCopyPath }}')" class="btn btn-danger mt-2"><i class="fa fa-close"></i> Delete</button>                                @endif
                            </x-media>
                        </x-modal>
                        @endif @error('passportCopy')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    @if(!$isCompleted)
                    <button type="reset" class="btn btn-danger">Reset</button>&nbsp; @endif
                    <button type="submit" class="btn btn-primary">{{ !$isCompleted ? 'Save & Next':'Next' }}</button>
                </div>
            </form>
        </div>
        <div class="col-md-2">
            <ul class="nav nav-pills flex-column text-center profile-tabs">
                @foreach($tabs as $id => $title)
                    @php
                        $isCompleted = match($id) {
                            'profile' => auth()->user()->drProfile()->exists(),
                            'high-school' => $drProfile->highSchool()->exists(),
                            'default' => false
                        }
                    @endphp
                    <li class="nav-item">
                        <a class="nav-link {{ $id == $activeTab ? 'tab-active' : '' }} {{ !$isCompleted ? 'disabled' : '' }}" aria-current="page" href="{{ $id == 'profile' ? route("doctor.profile") : route("doctor.profile.{$id}") }}">
                            @if($isCompleted)
                                <i class="fa fa-check-circle"></i>
                            @endif
                            {{ $title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>