<?php

namespace App\Http\Livewire\Doctor;

use Livewire\Component;
use App\Traits\Tabs;
use App\Models\Admin\Country;
use App\Models\Front\DrProfile;
use App\Http\Requests\InternshipRequest;
use App\Models\Front\Internship as InternshipModel;
use App\Traits\FileUpload;
use SebastianBergmann\Type\VoidType;
class Internship extends Component
{
    use Tabs, FileUpload;
    public $isCompleted;
    public $countries;
    public $drProfile;
    public $internships;
    public $state = [];
    public $terminationDoc;
    public $terminationDocPath;
    public $syndicateDoc;
    public $syndicateDocPath;
    public $certificate;
    public $certificatePath;
    public $iteration;
    public $folder;
    private $user;
    public $create = false;
    public $edit = false;
    public $internshipID;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function mount(): void
    {
        $this->user = auth()->user();
        $this->drProfile = DrProfile::findOrFail(auth()->user()->drProfile->id);
        $this->countries = Country::getAll();
        $this->isCompleted = $this->drProfile->internship()->exists() ? true : false;
        $this->folder = "doctors/{$this->user->id}/profile";
    }

    public function updatedTerminationDoc(): void
    {
        $this->validateOnly('terminationDoc', [
            'terminationDoc' => 'required|mimes:jpg,jpeg,png,PNG,pdf|max:12576'
        ]);

        $this->terminationDocPath = $this->upload($this->terminationDoc, 'termination_doc', $this->folder);
        $this->terminationDoc = null;
    }

    public function removeTerminationDoc(string $path): void
    {
        $this->removeUploadedFile($path);
        $this->terminationDocPath = null;
        $this->dispatchBrowserEvent('file_deleted', ['message' => 'the file successfully deleted!']);
        $this->iteration++;
    }

    public function updatedSyndicateDoc(): void
    {
        $this->validateOnly('syndicateDoc', [
            'syndicateDoc' => 'mimes:jpg,jpeg,png,PNG,pdf|max:12576'
        ]);

        $this->syndicateDocPath = $this->upload($this->syndicateDoc, 'syndicate_doc', $this->folder);
        $this->syndicateDoc = null;
    }

    public function removeSyndicateDoc(string $path): void
    {
        $this->removeUploadedFile($path);
        $this->syndicateDocPath = null;
        $this->dispatchBrowserEvent('file_deleted', ['message' => 'the file successfully deleted!']);
        $this->iteration++;
    }

    public function updatedCertificate(): void
    {
        $this->validateOnly('certificate', [
            'certificate' => 'mimes:jpg,jpeg,png,PNG,pdf|max:12576'
        ]);

        $this->certificatePath = $this->upload($this->certificate, 'certificate', $this->folder);
        $this->certificate = null;
    }

    public function removeCertificate(string $path): void
    {
        $this->removeUploadedFile($path);
        $this->certificatePath = null;
        $this->dispatchBrowserEvent('file_deleted', ['message' => 'the file successfully deleted!']);
        $this->iteration++;
    }

    public function store(): void
    {
        $this->validate();
        $this->state['dr_profile_id'] = $this->drProfile->id;
        $this->state['certificate'] = $this->certificatePath;
        $this->state['syndicate_doc'] = $this->syndicateDocPath;
        $this->state['termination_doc'] = $this->terminationDocPath;
        $this->updateOrCreate($this->state);
        $this->resetFields();
        $this->create = false;
        $this->emit('refreshComponent');
        $this->dispatchBrowserEvent('created', ['message' => 'Intership Created Successfully!']);        
    }

    private function updateOrCreate(array $fields, int $id = null):InternshipModel
    {
        return InternshipModel::updateOrCreate(
            ['id' => $id],
            $this->state
        );
    }

    public function addNew(): void 
    {
        $this->create = true;
        $this->resetFields();
    }

    private function resetFields(): void
    {
        $this->state = null;
        $this->certificate = null;
        $this->certificatePath = null;
        $this->terminationDoc = null;
        $this->terminationDocPath = null;
        $this->syndicateDoc = null;
        $this->syndicateDocPath = null;
        $this->iteration++;
    }

    public function rules(): array
    {
        return (new InternshipRequest)->rules();
    }

    public function deleteConfirmation(int $id): void
    {
        $this->internshipID = $id;
        $this->dispatchBrowserEvent('delete_confirm');
    }

    public function delete()
    {
        try {
            $internship = InternshipModel::findOrFail($this->internshipID);
            //delete certificate file if exists
            if($internship->certificate) {
                $this->deleteFile($internship->certificate);
            }
            //delete termination doc file if exists
            if($internship->termination_doc) {
                $this->deleteFile($internship->termination_doc);
            }
            //delete syndicate doc file if exists
            if($internship->syndicate_doc) {
                $this->deleteFile($internship->syndicate_doc);
            }

            $internship->delete();
            $this->internshipID = null;
            $this->dispatchBrowserEvent('file_deleted', ['message' => 'the internship successfully deleted!']);
            $this->dispatchBrowserEvent('hide_delete_confirm_modal');

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function deleteFile(string $path): void
    {
        $this->removeUploadedFile($path);
    }

    public function edit(int $id): void
    {
        $this->internshipID = $id;
        $internship = InternshipModel::findOrFail($id);
        $this->stateEdit($internship);
        $this->certificatePath = $internship->certificate;
        $this->terminationDocPath = $internship->termination_doc;
        $this->syndicateDocPath = $internship->syndicate_doc;
        $this->edit = true;
        $this->create = false;
    }

    public function update()
    {
        $this->validate();
        if ($this->certificatePath) {
            $this->state['certificate'] = $this->certificatePath;
        }

        if ($this->syndicateDocPath) {
            $this->state['syndicate_doc'] = $this->syndicateDocPath;
        }

        if ($this->terminationDocPath) {
            $this->state['termination_doc'] = $this->terminationDocPath;
        }
        $this->updateOrCreate($this->state, $this->internshipID);

        $this->emit('refreshComponent');
        $this->edit = false;
        $this->dispatchBrowserEvent('created', ['message' => 'Intership Updated Successfully!']);    
    }

    private function stateEdit($internship): array
    {
        return $this->state = [
            'internship_certified' => $internship->internship_certified,
            'internship_training' => $internship->internship_training,
            'country_id' => $internship->country_id,
            'hospital_name' => $internship->hospital_name,
            'sector' => $internship->sector,
            'duration' => $internship->duration,
            'start_date' => $internship->start_date,
            'end_date' => $internship->end_date,
        ];
    }

    public function render()
    {
        $this->internships = InternshipModel::with(['country'])->get();
        return view('livewire.doctor.internship', ['internships' => $this->internships])->layout('layouts.doctor');
    }


}
