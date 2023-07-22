<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UniversityController extends Controller
{
    protected $viewDir = "admin-sash.pages.taxonomy.universities.";
    // =========================================== List Of boardTypes =======================================
    public function index(Request $request)
    {
        // $universities = University::get();
        // return $universities;
        // return view($this->viewDir."list",compact(['universities']));

        if ($request->ajax()) {
            $data = University::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('Name En', function ($data) {
                    return $data->name_en;
                })
                ->editColumn('Name Ar', function ($data) {
                    return $data->name_ar;
                })
                ->editColumn('Country', function ($data) {
                    return $data->country_id;
                })
                ->editColumn('Status', function ($data) {
                    if ($data->Status == 1) {
                        $active = "Active";
                        return '<span class="status active">' . $active . '</span>';
                    } else {
                        $active = "Inactive";
                        return '<span class="status blocked">' . $active . '</span>';
                    }
                })
                ->addColumn('action', function ($data) {
                    $btn = '<div class="action__buttons">';
                    $btn = $btn.'<a href="' . route('universities.edit', $data->id) . '" class="btn-action"><span class="fe fe-edit"></span></a>';
                    $btn = $btn.'<a href="' . route('universities.destroy', $data->id) . '" class="btn-action delete"><span class="fe fe-trash-2"> </span></a>';
                    $btn = $btn.'</div>';
                    return $btn;
                })
                ->rawColumns(['name_en', 'name_ar', 'country_id', 'Status','action'])
                ->make(true);
        }
        $data['title'] = __('University List');
        // return view('admin.pages.brand.index', $data);
        return view($this->viewDir."list",$data);
    }

    // =========================================== create ===================================================
    public function create()
    {
        //
    }

    // =========================================== store ===================================================
    public function store(Request $request)
    {
        //
    }

    // =========================================== store ===================================================
    public function show(University $university)
    {
        //
    }

    // =========================================== store ===================================================
    public function edit(University $university)
    {
        //
    }

    // =========================================== store ===================================================
    public function update(Request $request, University $university)
    {
        //
    }

    // =========================================== store ===================================================
    public function destroy(University $university)
    {
        //
    }
}
