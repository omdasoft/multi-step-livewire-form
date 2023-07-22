<?php

namespace App\Http\Livewire\Doctor;

use Livewire\Component;
use App\Traits\Tabs;
use App\Models\Front\DrProfile;
use App\Models\Front\HighSchool as HighSchoolModel;
use App\Models\Admin\Country;
use App\Http\Requests\Doctor\HighSchoolRequest;
use App\Traits\FileUpload;
class HighSchool extends Component
{
    use Tabs, FileUpload;
    public $highSchool;
    public $drProfile;
    public $isCompleted;
    public $countries;
    public $iteration;
    public $file;
    public $filePath;
    public function mount()
    {
        $this->drProfile = DrProfile::findOrFail(auth()->user()->drProfile->id);
        $this->highSchool = $this->drProfile->highSchool()->exists() ? $this->drProfile->highSchool :  new HighSchoolModel();
        $this->isCompleted = $this->drProfile->highSchool()->exists() ? true : false;
        $this->studyField = $this->highSchool->field ?? '';
        $this->countries = Country::getAll();
        $this->filePath = $this->highSchool->file ?? '';
    }

    public function render()
    {
        return view('livewire.doctor.high-school')->layout('layouts.doctor');
    }

    public function removeFile(string $path)
    {
        $this->removeUploadedFile($path);
        $this->filePath = null;
        $this->iteration++;
    }

    public function updatedFile()
    {
        $this->validateOnly('file', [
            'file' => ['nullable', 'max:12576', 'mimes:pdf,jpeg,png,PNG,JPG'],
        ]);

        $userId = auth()->user()->id;
        $folder = "doctors/{$userId}/profile";
        $this->filePath = $this->upload($this->file, 'file', $folder);
        $this->file = null;
    }

    public function resetFields()
    {
        $this->countryId = null;
        $this->year = null;
        $this->file = null;
        $this->studyField = null;
        $this->filePath = null;
        $this->iteration++;
    }
    
    public function store()
    {
        $this->validate();
        $this->highSchool->dr_profile_id = $this->drProfile->id;
        $this->highSchool->file = $this->filePath;
        $this->highSchool->save();
        $this->resetFields();
        $this->dispatchBrowserEvent('created', ['message' => 'High School Created Successfully!']);
    }

    public function rules()
    {
        return (new HighSchoolRequest)->rules();
    }
}
