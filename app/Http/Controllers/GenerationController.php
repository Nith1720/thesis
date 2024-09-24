<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GenerationModel;

class GenerationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data['getRecord'] = GenerationModel::getAllRecord();
        return view('admin.generation.list', $data);
    }



    public function add(Request $request)
    {
        
        return view('admin.generation.add');
    }


    public function delete_generation($id, Request $request)
    {
        $RecordDelete = GenerationModel::getSingle($id);
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
    public function store(Request $request)
    {
        $save = new GenerationModel;
        $save->type_number = trim($request->type_number);
       
       
        $save->save();

        return redirect('admin/generation/list')->with('success', 'Successfully.');
    }

    public function edit_update($id, Request $request)
    {
    //    dd($request->all());
       $save = GenerationModel::getSingle($id);
       $save->type_number = trim($request->type_number);
       $save->save();

       return redirect('admin/generation/list')->with('success', 'Successfully Update.');
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
        $data['getRecord'] = GenerationModel::getSingle($id);
        return view('admin.generation.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
