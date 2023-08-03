<div>
    <div class="row">
        <div class="col-md-10">
            <form wire:submit.prevent="store">
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="country">Country</label>
                        <select class="form-control" id="country" wire:model="highSchool.country_id" {{ $isCompleted ? 'disabled' : '' }}>
                            <option value="">Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name_en }}</option>
                            @endforeach
                        </select> 
                        @error('highSchool.country_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="study_field">Study Field</label>
                        <input type="text" id="study_field" class="form-control" wire:model.defer="highSchool.study_field" {{ $isCompleted ? 'disabled' :
                            '' }}> 
                        @error('highSchool.study_field')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="year">Year</label>
                        <input type="date" id="year" class="form-control" wire:model.defer="highSchool.year" {{ $isCompleted ? 'disabled' :
                            '' }}> 
                        @error('highSchool.year')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="file">File</label>
                        <input type="file" id="file{{ $iteration }}" class="form-control" wire:model="file" {{ $isCompleted ?
                            'disabled' : '' }}> @if($filePath)
                        <x-modal title="View File Image">
                            <x-media path="{{ $filePath }}" downloadable="true" filename="file">
                                @if(!$isCompleted)
                                <button wire:click.prevent="removeFile('{{ $filePath }}')" class="btn btn-danger mt-2"><i class="fa fa-close"></i> Delete</button>                                @endif
                            </x-media>
                        </x-modal>
                        @endif @error('file')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    @if(!$isCompleted)
                    <button type="reset" class="btn btn-danger">Reset</button>&nbsp; 
                    @endif
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