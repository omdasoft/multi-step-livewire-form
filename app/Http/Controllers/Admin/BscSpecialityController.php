<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\BscSpeciality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BscSpecialityController extends Controller
{
    protected $viewDir = "admin-sash.pages.taxonomy.specialties.";
    // =========================================== List Of boardTypes ===================================================
    public function index()
    {
        $bscSpeciality = BscSpeciality::get();
        return view($this->viewDir."list",compact(['bscSpeciality']));
    }

    // =========================================== create ===================================================
    public function create()
    {
        //
    }

    // =========================================== store ===================================================
    public function store(Request $request)
    {
        BscSpeciality::create($request->all());
        return redirect()->route('speciality.index')->with('success', 'BscSpeciality created successfully.');
    }
    // =========================================== show ===================================================
    public function show(BscSpeciality $bscSpeciality)
    {
        //
    }

    // =========================================== edit ===================================================
    public function edit(BscSpeciality $bscSpeciality)
    {

    }

    // =========================================== update ===================================================
    public function update(Request $request, BscSpeciality $bscSpeciality)
    {
        $updated_data = [
          'name_ar'        =>$request->input('name_ar'),
          'name_en'        =>$request->input('name_en'),
          // 'status'         =>$request->input('status'),
        ];
        DB::transaction(function () use ($request, $updated_data,$bscSpeciality) {
            BscSpeciality::where('id', $request->speciality_id)->update($updated_data);
        });
        return back()->with('success','success add action');
    }

    // =========================================== destroy ===================================================
    public function destroy(BscSpeciality $bscSpeciality)
    {
        try {
          $bscSpeciality->delete();
           return redirect(route("speciality.index"));
        }catch (Throwable $exception) {
          return " can't delete dependany item";
        }
    }
}
