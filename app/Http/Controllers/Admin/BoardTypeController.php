<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\BoardType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BoardTypeController extends Controller
{
    protected $viewDir = "admin-sash.pages.taxonomy.boardtype.";

    // =========================================== List Of boardTypes ===================================================
    public function index()
    {
        $boardTypes = BoardType::get();
        return view($this->viewDir."list",compact(['boardTypes']));
    }

    // =========================================== Create New ===================================================
    public function create()
    {
 
    }
    // =========================================== Store ===================================================
    public function store(Request $request)
    {
        BoardType::create($request->all());
        return redirect()->route('boardType.index')->with('success', 'Board Type created successfully.');
    }

    // =========================================== Show ===================================================
    public function show(BoardType $boardType)
    {
        //
    }

    // =========================================== Edit ===================================================
    public function edit(BoardType $boardType)
    {
        // BoardType::findOrFail($boardType);
        // $boardType = BoardType::find($boardType);
        // if(!$boardType)
        // return redirect()->back();
        // return view('arabboard.admin.boardtype.edit',compact('boardType'));
    }

    // =========================================== Uppdate ===================================================
    public function update(Request $request, $boardType)
    {
        $updated_data = [
          'name_ar'        =>$request->input('name_ar'),
          'name_en'        =>$request->input('name_en'),
          'status'         =>$request->input('status'),
        ];
        DB::transaction(function () use ($request, $updated_data,$boardType) {
            BoardType::where('id', $request->board_id)->update($updated_data);
        });
        return back()->with('success','success add action');
    }

    // =========================================== Destroy ===================================================
    public function destroy(BoardType $boardType)
    {
         try {
          $boardType->delete();
           return redirect(route("boardType.index"));
        }catch (Throwable $exception) {
          return " can't delete dependany item";
        }
    }
}
