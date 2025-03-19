<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\LaboratoryProject;
use Illuminate\Http\Request;

class Phase3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('memla.phase3.index');
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
        //dd(count($datasets_type));

        /*
        $dt_test_tercio=Dataset::where("laboratory_id",$id)
            ->where('type_id',3)
            ->first();
        $dt_training_tercio=Dataset::where("laboratory_id",$id)
            ->where('type_id',4)
            ->first();
        */

        //$laboratoy_id = $id;
        //dd($dataset,$dataset_test_un_tercio,$dataset_training_un_tercio);

        return view('memla.phase3.index',compact('dataset'/*,'dt_test_tercio','dt_training_tercio'*/,'datasets_type','id','rows','laboratory_project'));
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
