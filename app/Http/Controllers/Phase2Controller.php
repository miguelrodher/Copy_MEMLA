<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\LaboratoryProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
class Phase2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $dataset_id=1;
    public function index()
    {
        $dataset=Dataset::where("laboratory_id",1)->first(); ##### change values for id laboratory project

        return view("memla.phase2.index",compact("dataset"));
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
        //dd($request->all());

        $request->validate([
            'file_upload'=>'required|file|mimes:csv,txt,xml',
            'file_upload.rows'=>"min:30",
        ]);

        $csv = Reader::createFromPath($request->file('file_upload'));
        $header = $csv->fetchOne();
        $recordCount = iterator_count($csv);
        if($recordCount < 31|| count($header) < 3)
            return redirect()->back()->withErrors(["error_size"=>"The dataset must have a minimum of 30 rows and 3 columns."]);


        $data=Dataset::where("laboratory_id",$request->id_project)->first();
        if(!$data)
        {
            $file= $request->file('file_upload');
            $data= $file->store("datasets","public");

            Dataset::create([
                "path"=>$data,
                "laboratory_id"=>$request->id_project, /**change for id of project**/
                "status" => 0,
                "type_id" => 1
            ]);
        }


        return redirect()->back();
        //dd($data);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $dataset=Dataset::where("laboratory_id",$id)
            ->where('type_id',1)    //Original dataset
            ->first(); ##### change values for id project
        $laboratory_project = LaboratoryProject::where('id',$id)->first();
            //dd($laboratory_project);
        return view("memla.phase2.index",compact("dataset",'id','laboratory_project'));

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
