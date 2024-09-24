<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeacherModel;
use App\Models\DepartmentModel;
use Str;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
         $data['getRecord'] = TeacherModel::getAllRecord();
        return view('admin.teacher.list', $data);
    }

    public function add(Request $request)
    {
        $data['getdepartment'] = DepartmentModel::get();
        return view('admin.teacher.add', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function delete_teacher($id, Request $request)
    {
        $RecordDelete = TeacherModel::getSingle($id);
        $RecordDelete->delete();

        return redirect()->back()->with('success', 'Successfully Delete.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    //    dd($request->all());
            $save = new TeacherModel;
            $save->frist_name  = trim($request->frist_name);
            $save->last_name  = trim($request->last_name);
            $save->gender  = trim($request->gender);
            $save->email  = trim($request->email);
            $save->specialty  = trim($request->specialty);
            $save->phone  = trim($request->phone);
            $save->degree  = trim($request->degree);
            $save->department_id  = trim($request->department_id);
            $save->status  = trim($request->status);
            if(!empty($request->file('profile_pic'))){
                $file = $request->file('profile_pic');
                $randomStr = Str::random(30);
                $filename = $randomStr. '.'.$file->getClientOriginalExtension();
                $file->move('Image/profile/', $filename);
                $save->profile_pic  = $filename;
            }

             $save->save();

            return redirect('admin/teacher/list')->with('success', 'Successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data['getRecord'] = TeacherModel::getSingle($id);
        $data['getdepartment'] = DepartmentModel::get();
        $data['getRecord'] = TeacherModel::getSingle($id);
        return view('admin.teacher.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $data['getdepartment'] = DepartmentModel::get();
        $data['getRecord'] = TeacherModel::getSingle($id);
        return view('admin.teacher.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function edit_update($id, Request $request)
    {
       // dd($request->all());
       $save = TeacherModel::getSingle($id);
       $save->frist_name  = trim($request->frist_name);
       $save->last_name  = trim($request->last_name);
       $save->gender  = trim($request->gender);
       $save->email  = trim($request->email);
       $save->specialty  = trim($request->specialty);
       $save->degree  = trim($request->degree);
       $save->phone  = trim($request->phone);
       $save->department_id  = trim($request->department_id);
       $save->status  = trim($request->status);
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

       return redirect('admin/teacher/list')->with('success', 'Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
