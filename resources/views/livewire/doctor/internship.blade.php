<div>
    <div class="row">
        <div class="col-md-10">
            @if($create)
                @include('livewire.doctor.partials.internship.create'); 
            @endif 
            @if(!$create && !$edit)
                <div class="mb-3">
                    <button class="btn btn-primary" wire:click.prevent="addNew">Add New</button>
                </div>
            @endif
            @if($edit)
                @include('livewire.doctor.partials.internship.edit'); 
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>Id</th>
                        <th>Hosbital Name</th>
                        <th>Sector</th>
                        <th>Duration</th>
                        <th>Internship Certified</th>
                        <th>Country</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>#</th>
                    </thead>
                    <tbody>
                        @forelse($internships as $internship)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $internship->hospital_name }}</td>
                                <td>{{ $internship->sector }}</td>
                                <td>{{ $internship->duration }}</td>
                                <td>{{ $internship->is_certified_internship }}</td>
                                <td>{{ $internship->country->name }}</td>
                                <td>{{ $internship->start_date }}</td>
                                <td>{{ $internship->end_date }}</td>
                                <td>
                                    <a href="#" wire:click.prevent="deleteConfirmation({{$internship->id}})"><i class="fa fa-trash text-danger"></i></a>
                                    <a href="#" wire:click.prevent="edit({{$internship->id}})"><i class="fa fa-edit text-warning"></i></a>
                                </td>
                            </tr>
                        @empty
                        <tr class="text-center">
                            <td colspan="9" class="p-4"><span class="lead">No Data Found</span></td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end mt-3">
                @if($isCompleted)
                <button type="submit" class="btn btn-primary">Next</button> @endif
            </div>
        </div>
        <div class="col-md-2">
            @include('livewire.doctor.partials.tabs');
        </div>
    </div>
    <div class="modal fade" id="deleteConfirm" tabindex="-1" aria-labelledby="deleteConfirmLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                   <p class="lead">are you sure ?</p
                </div>
                <div class="modal-footer">
                    <button wire:click.prevent="delete" type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>