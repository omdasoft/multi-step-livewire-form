<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\SubSpeciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubSpecialityController extends Controller
{
    protected $viewDir = "admin-sash.pages.taxonomy.specialties.";
    // =========================================== List Of boardTypes =======================================
    public function index()
    {
        $subSpecialities = SubSpeciality::get();
        return view($this->viewDir."list",compact(['subSpecialities']));
    }
    // =========================================== create ===================================================
    public function create()
    {
        //
    }
    // =========================================== store ===================================================
    public function store(Request $request)
    {
        SubSpeciality::create($request->all());
        return redirect()->route('speciality.index')->with('success', 'SubSpeciality created successfully.');
    }
    // =========================================== store ===================================================
    public function show(SubSpeciality $subSpeciality)
    {
        //
    }
    // =========================================== store ===================================================
    public function edit(SubSpeciality $subSpeciality)
    {
        //
    }
    // =========================================== store ===================================================
    public function update(Request $request, SubSpeciality $subSpeciality)
    {
        // return $request;
        $updated_data = [
          'name_ar'        =>$request->input('name_ar'),
          'name_en'        =>$request->input('name_en'),
          'bsc_id'            =>$request->input('bsc_id'),
          'general_id'            =>$request->input('general_id'),
        ];
        DB::transaction(function () use ($request, $updated_data) {
            SubSpeciality::where('id', $request->speciality_id)->update($updated_data);
        });
        return back()->with('success','success add action');
    }
    // =========================================== store ===================================================
    public function destroy(SubSpeciality $subSpeciality)
    {
        try {
          $subSpeciality->delete();
           return redirect(route("speciality.index"));
        }catch (Throwable $exception) {
          return " can't delete dependany item";
        }
    }
}
