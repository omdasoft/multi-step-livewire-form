<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Speciality;
use App\Models\BscSpeciality;
use App\Models\GeneralSpeciality;
use App\Models\SubSpeciality;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SpecialityController extends Controller
{
    protected $viewDir = "admin-sash.pages.taxonomy.specialties.";
    // =========================================== List Of boardTypes ===================================================
    public function index()
    {
        $specialities = Speciality::get();
        // $bscSpecialities = Speciality::where('speciality_type','1')->get();
        // $generalSpecialities = Speciality::where('speciality_type','2')->get();
        $bscSpecialities = BscSpeciality::get();
        $generalSpecialities = GeneralSpeciality::with('bscSpeciality')->get();

        // return $generalSpecialities;
        
        $subSpecialities = SubSpeciality::get();
        return view($this->viewDir."list",compact(['bscSpecialities','generalSpecialities','specialities','subSpecialities']));
    }
    // =========================================== Create New ===================================================
    public function create()
    {

    }
    // =========================================== Store ===================================================
    public function store(Request $request)
    {
        Speciality::create($request->all());
        return redirect()->route('speciality.index')->with('success', 'Board Type created successfully.');
    }
    // =========================================== Show ===================================================
    public function show(Speciality $speciality)
    {
        //
    }
    // =========================================== Edit ===================================================
    public function edit(Speciality $speciality)
    {
        //
    }
    // =========================================== Uppdate ===================================================
    public function update(Request $request, Speciality $speciality)
    {
        $updated_data = [
          'name_ar'        =>$request->input('name_ar'),
          'name_en'        =>$request->input('name_en'),
          'status'         =>$request->input('status'),
        ];
        DB::transaction(function () use ($request, $updated_data,$speciality) {
            Speciality::where('id', $request->board_id)->update($updated_data);
        });
        return back()->with('success','success add action');
    }
    // =========================================== Destroy ===================================================
    public function destroy(Speciality $speciality)
    {
        try {
          $speciality->delete();
           return redirect(route("speciality.index"));
        }catch (Throwable $exception) {
          return " can't delete dependany item";
        }
    }
}
