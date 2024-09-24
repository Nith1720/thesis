<?php

namespace App\Http\Controllers;

use App\Models\ScoreModel;
use App\Models\ThesisModel;
use App\Models\StudentModel;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['getRecord'] = ScoreModel::getAllRecord();
        return view('admin.score.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function add(Request $request)
    {
        $data['thesis'] = ThesisModel::get();
        $data['student'] = StudentModel::get();
        return view('admin.score.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $save = new ScoreModel;
        $save->thesis_id  = trim($request->thesis_id);
        $save->student_id  = trim($request->student_id);
        $save->score  = trim($request->score);
        $save->save();

        return redirect('admin/score/list')->with('success', 'Successfully.');
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
        $data['department'] = DepartmentModel::get();
        $data['generation'] = GenerationModel::get();
        $data['getRecord'] = ScoreModel::getSingle($id);
        return view('admin.score.edit', $data);
    }
    /**
     * Update the specified resource in storage.
     */
    public function edit_update($id, Request $request)
    {
       // dd($request->all());
       $save = ScoreModel::getSingle($id);
       $save->thesis_id  = trim($request->thesis_id);
       $save->student_id  = trim($request->student_id);
       $save->score  = trim($request->score);
       $save->save();

       return redirect('admin/score/list')->with('success', 'Successfully.');
       }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
