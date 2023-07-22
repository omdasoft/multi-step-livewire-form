<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\GeneralSpeciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GeneralSpecialityController extends Controller
{
    protected $viewDir = "admin-sash.pages.taxonomy.specialties.";
    // =========================================== List Of boardTypes =======================================
    public function index()
    {
        $generalSpecialities = GeneralSpeciality::get();
        return view($this->viewDir."list",compact(['generalSpecialities']));
    }

    // =========================================== create ===================================================
    public function create()
    {
        //
    }

    // =========================================== store ===================================================
    public function store(Request $request)
    {
        GeneralSpeciality::create($request->all());
        return redirect()->route('speciality.index')->with('success', 'GeneralSpeciality created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GeneralSpeciality $generalSpeciality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GeneralSpeciality $generalSpeciality)
    {
        $updated_data = [
          'name_ar'        =>$request->input('name_ar'),
          'name_en'        =>$request->input('name_en'),
          'bsc_id'        =>$request->input('bsc_id'),
          'status'         =>$request->input('status'),
        ];
        DB::transaction(function () use ($request, $updated_data,$generalSpeciality) {
            GeneralSpeciality::where('id', $request->board_id)->update($updated_data);
        });
        return back()->with('success','success add action');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GeneralSpeciality $generalSpeciality)
    {
        // return $request;
        $updated_data = [
          'name_ar'        =>$request->input('name_ar'),
          'name_en'        =>$request->input('name_en'),
          'bsc_id'        =>$request->input('bsc_id'),
          // 'status'         =>$request->input('status'),
        ];
        DB::transaction(function () use ($request, $updated_data,$generalSpeciality) {
            GeneralSpeciality::where('id', $request->speciality_id)->update($updated_data);
        });
        return back()->with('success','success add action');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GeneralSpeciality $generalSpeciality)
    {
        try {
          $generalSpeciality->delete();
           return redirect(route("speciality.index"));
        }catch (Throwable $exception) {
          return " can't delete dependany item";
        }
    }
}
