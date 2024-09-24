<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentModel;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['getRecord'] = DepartmentModel::getAllRecord();
        return view('admin.department.list',$data);
    }


    public function add(Request $request)
    {
        
        return view('admin.department.add');
    }

    public function store(Request $request)
    {
        $save = request()->validate([
            'type_name' => 'required'
           
            
        ]);
        // dd($request->type_name);
        $save = new DepartmentModel;
        $save->type_name = trim($request->type_name);
        $save->description = trim($request->description);
       
       
        $save->save();

        return redirect('admin/department/list')->with('success', 'Successfully.');
    }
    
    public function delete_department($id, Request $request)
    {
        $RecordDelete = DepartmentModel::getSingle($id);
        $RecordDelete->delete();

        return redirect()->back()->with('success', 'Successfully Delete.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $data['getRecord'] = DepartmentModel::getSingle($id);
        return view('admin.department.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit_update($id, Request $request)
    {
       // dd($request->all());
       $save = DepartmentModel::getSingle($id);
       $save->type_name = trim($request->type_name);
       $save->description = trim($request->description);
       $save->save();

       return redirect('admin/department/list')->with('success', 'Successfully Update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
