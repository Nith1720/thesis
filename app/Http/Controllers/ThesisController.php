<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentModel;
use App\Models\GenerationModel;
use App\Models\TeacherModel;
use App\Models\ThesisModel;
use App\Models\StudentModel;


class ThesisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['getRecord'] = ThesisModel::getAllRecord();
        return view('admin.thesis.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(Request $request)
    {

        return view('admin.thesis.add');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $save = new ThesisModel;
        $save->title_kh  = trim($request->title_kh);
        $save->title_en  = trim($request->title_en);
        $save->teacher_id  = trim($request->teacher_id);
        $save->generation_id  = trim($request->generation_id);
        $save->department_id  = trim($request->department_id);
        $save->date  = trim($request->date);
        $save->save();
        return redirect('admin/thesis/list')->with('success', 'Successfully.');
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
    public function edit(string $id)
    {
        $data['thesis'] = ThesisModel::get();
        $data['student'] = StudentModel::get();
        $data['getRecord'] = ThesisModel::getSingle($id);
        return view('admin.thesis.edit', $data);
    }
    /**
     * Update the specified resource in storage.
     */
    public function edit_update($id, Request $request)
    {
        $save = ThesisModel::getSingle($id);
        $save->title_kh  = trim($request->title_kh);
        $save->title_en  = trim($request->title_en);
        $save->teacher_id  = trim($request->teacher_id);
        $save->generation_id  = trim($request->generation_id);
        $save->department_id  = trim($request->department_id);
        $save->date  = trim($request->date);
        $save->save();
        return redirect('admin/thesis/list')->with('success', 'Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
