<?php

namespace App\Http\Livewire\Doctor;

use Livewire\Component;
use App\Models\Front\DrProfile;
use App\Http\Requests\Doctor\ProfileRequest;
use App\Traits\FileUpload;
use App\Traits\Tabs;
use App\Models\Admin\Nationality;
use App\Models\Admin\Country;
use App\Models\Admin\State;
use App\Models\Admin\City;
class Profile extends Component
{
    use FileUpload, Tabs;

    public $drProfile;
    public $personalImage;
    public $passportCopy;
    public $personalImagePath;
    public $passportCopyPath;
    public $user;
    public $folder;
    public $nationalities;
    public $countries;
    public $states = [];
    public $cities = [];
    public $countryId;
    public $stateId;
    public $iteration;
    public $isCompleted;

    //protected $listeners = ['profileSaved' => '$refresh'];
    // protected $listeners = ['refreshComponent' => '$refresh'];


    public function mount()
    {
        $this->user = auth()->user();
        $this->folder = "doctors/{$this->user->id}/profile";
        $this->nationalities = Nationality::getAll();
        $this->countries = Country::getAll();
        $this->drProfile = $this->user->drProfile ?? new DrProfile();
        $this->isCompleted = $this->user->drProfile()->exists() ? true:false;
        $this->setVales();
    }

    public function setVales()
    {
        $this->countryId = $this->drProfile->country_id ?? '';
        $this->states = State::where('country_id', $this->countryId)->get();
        $this->stateId = $this->drProfile->state_id ?? '';
        $this->cities = City::where('state_id', $this->stateId)->get();
        $this->cityId = $this->drProfile->city_id ?? '';
        $this->personalImagePath = $this->drProfile->personal_image ?? '';
        $this->passportCopyPath = $this->drProfile->passport_copy ?? '';
    }

    public function updatedPersonalImage()
    {
        $this->validateOnly('personalImage', [
            'personalImage' => ['nullable', 'max:12576', 'mimes:jpg,jpeg,png,PNG,JPG'],
        ]);

        $this->personalImagePath= $this->upload($this->personalImage, 'personal_image', $this->folder);
        $this->personalImage = null;
    }

    public function updatedPassportCopy()
    {
        $this->validateOnly('passportCopy', [
            'passportCopy' => ['nullable', 'max:12576', 'mimes:jpg,jpeg,png,PNG,JPG'],
        ]);
            
        $this->passportCopyPath = $this->upload($this->passportCopy, 'passport_copy', $this->folder);
        $this->passportCopy = null;
    }

    public function updatedCountryId()
    {
       $this->getCountrySatates($this->countryId);
    }

    public function getCountrySatates(int $countryId)
    {
        $this->states = State::where('country_id', $countryId)->orderBy('name_en', 'ASC')->get();
    }

    public function updatedStateId()
    {
        $this->getStateCities($this->stateId);
    }

    public function getStateCities(int $stateId)
    {
        $this->cities = City::where('state_id', $stateId)->orderBy('name_en', 'ASC')->get();
    }

    public function store()
    {
        // if($this->isCompleted) {
        //     return redirect()->route('doctor.profile.high-school');
        // }

        $this->validate();
        $this->drProfile->user_id = $this->user->id;
        $this->drProfile->personal_image = $this->personalImagePath;
        $this->drProfile->passport_copy = $this->passportCopyPath;
        $this->drProfile->country_id = $this->countryId;
        $this->drProfile->state_id = $this->stateId;
        $this->drProfile->city_id = $this->cityId;
        $this->drProfile->save();
        $this->isCompleted = true;
        $this->resetFields();
        $this->dispatchBrowserEvent('created', ['message' => 'High School Created Successfully!']);

        //return redirect()->route('doctor.profile.high-school');
        //session()->flash('success','Profile Saved Successfully!!');
        //->with('success', 'Profile Sussessfully Saved!');
        //$this->mount();
        //$this->emit('profileSaved');
    }

    public function resetFields()
    {
        $this->drProfile = null;
        $this->personal_image = null;
        $this->passport_copy = null;
        $this->countryId = null;
        $this->stateId = null;
        $this->personalImagePath = null;
        $this->passportCopyPath = null;
        $this->iteration++;
    }

    public function removePassportCopy(string $path)
    {
        $this->removeUploadedFile($path);
        $this->passportCopyPath = null;
        $this->iteration++;
        $this->dispatchBrowserEvent('file_deleted', ['message' => 'the file successfully deleted!']);
    }

    public function removePersonalImage(string $path)
    {
        $this->removeUploadedFile($path);
        $this->personalImagePath = null;
        $this->iteration++;
        $this->dispatchBrowserEvent('file_deleted', ['message' => 'the file successfully deleted!']);
    }

    public function rules()
    {
       return (new ProfileRequest)->rules();
    }

    public function render()
    {
        return view('livewire.doctor.profile')->layout('layouts.doctor');
    }
}
