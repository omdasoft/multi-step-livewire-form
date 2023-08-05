<?php

namespace App\Http\Livewire\Doctor;

use Livewire\Component;
use App\Traits\Tabs;
use App\Models\Admin\Country;
use App\Models\Front\DrProfile;
use App\Http\Requests\InternshipRequest;
use App\Models\Front\Internship as InternshipModel;
use App\Traits\FileUpload;
class Internship extends Component
{
    use Tabs, FileUpload;
    public $isCompleted;
    public $countries;
    public $drProfile;
    public $internship;
    public $terminationDoc;
    public $terminationDocPath;
    public $syndicateDoc;
    public $syndicateDocPath;
    public $certificate;
    public $certificatePath;
    public $iteration;
    public $folder;
    private $user;
    public function mount()
    {
        $this->user = auth()->user();
        $this->drProfile = DrProfile::findOrFail(auth()->user()->drProfile->id);
        $this->internship = $this->drProfile->internship()->exists() ? $this->drProfile->internship : new InternshipModel();
        $this->countries = Country::getAll();
        $this->isCompleted = false;
        $this->folder = "doctors/{$this->user->id}/profile";
    }

    public function updatedTerminationDoc()
    {
        $this->validateOnly('terminationDoc', [
            'terminationDoc' => 'required|mimes:jpg,jpeg,png,PNG,pdf|max:12576'
        ]);

        $this->terminationDocPath = $this->upload($this->terminationDoc, 'termination_doc', $this->folder);
        $this->terminationDoc = null;
    }

    public function removeTerminationDoc(string $path)
    {
        $this->removeUploadedFile($path);
        $this->terminationDocPath = null;
        $this->dispatchBrowserEvent('file_deleted', ['message' => 'the file successfully deleted!']);
        $this->iteration++;
    }

    public function updatedSyndicateDoc()
    {
        $this->validateOnly('syndicateDoc', [
            'syndicateDoc' => 'required|mimes:jpg,jpeg,png,PNG,pdf|max:12576'
        ]);

        $this->syndicateDocPath = $this->upload($this->syndicateDoc, 'syndicate_doc', $this->folder);
        $this->syndicateDoc = null;
    }

    public function removeSyndicateDoc(string $path)
    {
        $this->removeUploadedFile($path);
        $this->syndicateDocPath = null;
        $this->dispatchBrowserEvent('file_deleted', ['message' => 'the file successfully deleted!']);
        $this->iteration++;
    }

    public function updatedCertificate()
    {
        $this->validateOnly('certificate', [
            'certificate' => 'required|mimes:jpg,jpeg,png,PNG,pdf|max:12576'
        ]);

        $this->certificatePath = $this->upload($this->certificate, 'certificate', $this->folder);
        $this->certificate = null;
    }

    public function removeCertificate(string $path)
    {
        $this->removeUploadedFile($path);
        $this->certificatePath = null;
        $this->dispatchBrowserEvent('file_deleted', ['message' => 'the file successfully deleted!']);
        $this->iteration++;
    }

    public function store()
    {
        $this->validate();
        $this->internship->certificate = $this->certificatePath;
        $this->internship->syndicate_doc = $this->syndicateDocPath;
        $this->internship->termination_doc = $this->terminationDocPath;
        $this->internship->save();
        $this->dispatchBrowserEvent('created', ['message' => 'Intership Created Successfully!']);        
    }

    public function rules()
    {
        return (new InternshipRequest)->rules();
    }
    public function render()
    {
        return view('livewire.doctor.internship')->layout('layouts.doctor');
    }
}
