<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentModel;
use App\Models\DepartmentModel;
use App\Models\GenerationModel;
use Str;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['getRecord'] = StudentModel::getAllRecord();
        return view('admin.student.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function add(Request $request)
    {
        $data['generation'] = GenerationModel::get();
        $data['getdepartment'] = DepartmentModel::get();
        return view('admin.student.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $save = new StudentModel;
        $save->frist_name  = trim($request->frist_name);
        $save->last_name  = trim($request->last_name);
        $save->gender  = trim($request->gender);
        $save->dob  = trim($request->dob);
        $save->email  = trim($request->email);
        $save->phone  = trim($request->phone);
        $save->department_id  = trim($request->department_id);
        $save->generation_id  = trim($request->generation_id);
        $save->shift  = trim($request->shift);
        if(!empty($request->file('profile_pic'))){
            $file = $request->file('profile_pic');
            $randomStr = Str::random(30);
            $filename = $randomStr. '.'.$file->getClientOriginalExtension();
            $file->move('Image/profile/', $filename);
            $save->profile_pic  = $filename;
        }

         $save->save();

        return redirect('admin/student/list')->with('success', 'Successfully.');
    }



    public function delete_student($id, Request $request)
    {
        $RecordDelete = StudentModel::getSingle($id);
        $RecordDelete->delete();

        return redirect()->back()->with('success', 'Successfully Delete.');
    }

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
        $data['generation'] = GenerationModel::get();
        $data['getdepartment'] = DepartmentModel::get();
        $data['getRecord'] = StudentModel::getSingle($id);
        return view('admin.student.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit_update($id, Request $request)
    {
       // dd($request->all());
       $save = StudentModel::getSingle($id);
        $save->frist_name  = trim($request->frist_name);
        $save->last_name  = trim($request->last_name);
        $save->gender  = trim($request->gender);
        $save->dob  = trim($request->dob);
        $save->email  = trim($request->email);
        $save->phone  = trim($request->phone);
        $save->department_id  = trim($request->department_id);
        $save->generation_id  = trim($request->generation_id);
        $save->shift  = trim($request->shift);
        if(!empty($request->file('profile_pic'))){

        if(!empty($save->profile_pic) && file_exists('Image/profile/'.$save->profile_pic)){
            unlink('Image/profile/'.$save->profile_pic);
        }



        $file = $request->file('profile_pic');
        $randomStr = Str::random(30);
        $filename = $randomStr. '.'.$file->getClientOriginalExtension();
        $file->move('Image/profile/', $filename);
        $save->profile_pic  = $filename;
    }

     $save->save();

    return redirect('admin/student/list')->with('success', 'Successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
