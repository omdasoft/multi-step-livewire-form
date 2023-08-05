<div>
    <div class="row">
        <div class="col-md-10">
            <form wire:submit.prevent="store">
                <div class="row">
                    <div class="col-md-4">
                        <label for="internship_certificate">Internship Certificate</label><br>
                        <input type="radio" class="form-check-input" id="internship_certificate" name="internship_certificate" value="1" wire:model.defer="internship.internship_certificate"
                            {{ $isCompleted ? 'disabled' : '' }}> Completed
                        <input type="radio" class="form-check-input" id="internship_certificate" name="internship_certificate" value="0" wire:model.defer="internship.internship_certificate"
                            {{ $isCompleted ? 'disabled' : '' }}> Incompleted 
                        @error('internship.internship_certificate')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="internship_training">Internship Training</label><br>
                        <input type="radio" class="form-check-input" id="internship_training" name="internship_training" value="1" wire:model.defer="internship.internship_training"
                            {{ $isCompleted ? 'disabled' : '' }}> Completed
                        <input type="radio" class="form-check-input" id="internship_training" name="internship_training" value="0" wire:model.defer="internship.internship_training"
                            {{ $isCompleted ? 'disabled' : '' }}> Incompleted 
                        @error('internship.internship_training')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="country">Country</label>
                        <select class="form-control" id="country" wire:model="internship.country_id" {{ $isCompleted ? 'disabled' : '' }}>
                            <option value="">Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name_en }}</option>
                            @endforeach
                        </select> 
                        @error('internship.country_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="hospital_name">hospital_name</label><br>
                        <input type="text" class="form-control" id="hospital_name" wire:model.defer="internship.hospital_name" {{ $isCompleted
                            ? 'disabled' : '' }}> 
                        @error('internship.hospital_name')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="sector">Sector</label><br>
                        <input type="text" class="form-control" id="sector" wire:model.defer="internship.sector" {{ $isCompleted
                            ? 'disabled' : '' }}> 
                        @error('internship.sector')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="duration">Duration</label><br>
                        <input type="text" class="form-control" id="duration" wire:model.defer="internship.duration" {{ $isCompleted
                            ? 'disabled' : '' }}> 
                        @error('internship.duration')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="start_date">Start Date</label><br>
                        <input type="date" class="form-control" id="start_date" wire:model.defer="internship.start_date" {{ $isCompleted
                            ? 'disabled' : '' }}> 
                        @error('internship.start_date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="end_date">End Date</label><br>
                        <input type="date" class="form-control" id="end_date" wire:model.defer="internship.end_date" {{ $isCompleted
                            ? 'disabled' : '' }}> 
                        @error('internship.end_date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="termination_doc">Termination Doc</label><br>
                    <input type="file" class="form-control" id="termination_doc{{ $iteration }}" wire:model="terminationDoc" {{ $isCompleted
                            ? 'disabled' : '' }} wire:loading.class="opacity-40"> 
                        @if($terminationDocPath)
                            <x-modal title="View Termination Doc">
                                <x-media path="{{ $terminationDocPath }}" downloadable="true" filename="termination_doc">
                                    @if(!$isCompleted)
                                        <button wire:click.prevent="removeTerminationDoc('{{ $terminationDocPath }}')" class="btn btn-danger mt-2"><i class="fa fa-close"></i> Delete</button>                                
                                    @endif
                                </x-media>
                            </x-modal>
                        @endif
                        @error('terminationDoc')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>                   
                </div>
                <div class="row mt-2">
                    <div class="col-md-4">
                        <label for="certificate">Certificate</label><br>
                    <input type="file" class="form-control" id="certificate{{ $iteration }}" wire:model="certificate" {{ $isCompleted
                            ? 'disabled' : '' }} wire:loading.class="opacity-50"> 
                        @if($certificatePath)
                            <x-modal title="View Certificate">
                                <x-media path="{{ $certificatePath }}" downloadable="true" filename="certificate">
                                    @if(!$isCompleted)
                                        <button wire:click.prevent="removeCertificate('{{ $certificatePath }}')" class="btn btn-danger mt-2"><i class="fa fa-close"></i> Delete</button>                                
                                    @endif
                                </x-media>
                            </x-modal>
                        @endif
                        @error('certificate')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>            
                    <div class="col-md-4">
                        <label for="syndicate_doc">Syndicate Doc</label><br>
                        <input type="file" class="form-control" id="syndicate_doc{{ $iteration }}" wire:model="syndicateDoc" {{ $isCompleted
                            ? 'disabled' : '' }} wire:loading.class="opacity-50"> 
                        @if($syndicateDocPath)
                            <x-modal title="View Syndicate Doc">
                                <x-media path="{{ $syndicateDocPath }}" downloadable="true" filename="certificate">
                                    @if(!$isCompleted)
                                        <button wire:click.prevent="removeSyndicateDoc('{{ $syndicateDocPath }}')" class="btn btn-danger mt-2"><i class="fa fa-close"></i> Delete</button>                                
                                    @endif
                                </x-media>
                            </x-modal>
                        @endif
                        @error('syndicateDoc')
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
            @include('livewire.doctor.partials.tabs');
        </div>
    </div>
</div>