<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Feature;
use App\Models\LaboratoryProject;
use Illuminate\Http\Request;

class Phase4Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        return view('memla.phase4.index');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $rows)
    {
        $laboratory_project = LaboratoryProject::where('id',$id)->first();

        $target = LaboratoryProject::where('id', $id)->value('target');
        $features = Feature::where('laboratory_id',$id)->pluck('feature_name');
        //dd($target, $features);


        $dataset=Dataset::where("laboratory_id",$id)
            ->where('type_id',1)    //Change type of dataset for preproceced (2)
            ->first();

        $datasets_type = [
            Dataset::where("laboratory_id",$id)
                ->where('type_id',3)
                ->first(),
            Dataset::where("laboratory_id",$id)
                ->where('type_id',4)
                ->first(),
            Dataset::where("laboratory_id",$id)
                ->where('type_id',5)
                ->first(),
            Dataset::where("laboratory_id",$id)
                ->where('type_id',6)
                ->first(),
            Dataset::where("laboratory_id",$id)
                ->where('type_id',7)
                ->first(),
            Dataset::where("laboratory_id",$id)
                ->where('type_id',8)
                ->first(),
        ];

        return view('memla.phase4.index',compact('id','rows','laboratory_project','dataset','datasets_type','target','features'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
