<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\LaboratoryProject;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Phase2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        /*try {
            //dd($this->callServer("/load_file/?".http_build_query($data)));
            return $this->callServer("/probarconexion/");
        }
        catch (\Exception $e)
        {
            return $e;
        }*/

        /*try {

            //dd($this->callServer("/load_file/?".http_build_query($data)));
            return $this->callServer("/load_file/?path_file=http://10.147.20.154:5001/storage/datasets/f7X6G4wvI6TpwgK0l1DlKpEiNaCPznzofiMT8xfq.csv&name_file=datasets/f7X6G4wvI6TpwgK0l1DlKpEiNaCPznzofiMT8xfq.csv");
        }
        catch (\Exception $e)
        {
            return $e;
        }*/
        try {
            $data = array('titulo' => $request->title_project,
                'path_file' => asset("storage/".$request->file_path),
                'name_file'=>$request->file_path,
            );
            //dd($data);
            //dd($this->callServer("/load_file/?".http_build_query($data)));
            return $this->callServer("/load_file/?".http_build_query($data));
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function loadoutliers(Request $request)
    {
        try {
            //dd("hola buenas");
            $data = array('titulo' => $request->title_project,
                'path_file' => asset("storage/".$request->file_path),
                'name_file'=>$request->file_path,
                'selected_target'=>$request->target,
            );
            //dd($this->callServer("/load_file/?".http_build_query($data)));
            return $this->callServer("/load_outliers/?".http_build_query($data));
        }
        catch (\Exception $e)
        {
            return $e;
        }
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
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //dd("holaquetal vas a actualizar papu");
        //dd($request);
        try {
            $data = array('titulo' => $request->title_project,
                'name_file'=>$request->name_file,
                'target'=>$request->target,
                'features'=>$request->features,
            );
            $new_target = $this->callServer("/update_dataset/?".http_build_query($data));

            $new_target_data = $new_target->getData(true); // Convertir a array
            //dd($new_target_data['index_column']);

            $laboratory = LaboratoryProject::find($request->laboratory_id);

            $laboratory->target = $new_target_data['index_column']; //esto esta mal no se por que
            //dd("hasta aca tofo bein");

            $features_array = explode(',', $request->features);
            foreach ($features_array as $feature){
                Feature::create([
                    'feature_name'=>$feature,
                    'laboratory_id'=>$request->laboratory_id
                ]);
            }
            $laboratory->save();

            return redirect()->back();
        }
        catch (\Exception $e)
        {
            return $e;
        }

        /*$laboratory = LaboratoryProject::find($request->laboratory_id);
        $laboratory->update([
            'target'=>$laboratory->target,
        ]);*/

        //return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function changeValue(Request $request)
    {
        try {
            $data = array('titulo' => $request->title_project,
                'name_file'=>$request->name_file,
                'columnTitle'=>$request->columnTitle,
                'back_value'=>$request->back_value,
                'new_value'=>$request->new_value,
                'columnType'=>$request->columnType,
            );

            return $this->callServer("/change_value/?".http_build_query($data));

        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function deleteValues(Request $request)
    {
        try {
            $data = array('titulo' => $request->title_project,
                'path_file'=>$request->name_file,
            );
            return $this->callServer("/delete_duplicate/?".http_build_query($data));
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function deleteColumns(Request $request)
    {
        try {
            $data = array('titulo' => $request->title_project,
                'path_file'=>$request->name_file,
                'column_name'=>$request->name_col,
            );
            return $this->callServer("/drop_column/?".http_build_query($data));
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function encode_ordinal(Request $request)
    {
        try {
            $data = array('titulo' => $request->title_project,
                'path_file'=>$request->name_file,
                'column_name'=>$request->name_col,
                'column_values'=>$request->col_values,
            );
            return $this->callServer("/encode_column_o/?".http_build_query($data));
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function encode_nominal(Request $request)
    {
        try {
            $data = array('titulo' => $request->title_project,
                'path_file'=>$request->name_file,
                'column_name'=>$request->name_col,
            );
            return $this->callServer("/encode_column_n/?".http_build_query($data));
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }
    public function handleOutliers(Request $request)
    {
        try {
            $data = array('titulo' => $request->title_project,
                'path_file'=>$request->name_file,
                'column_name'=>$request->name_col,
                'numeric'=>$request->num,
                'str'=>$request->string,
                'way'=>$request->selected_way,
                'type'=>$request->datatype,
            );
            return $this->callServer("/handle_outliers/?".http_build_query($data));
        }
        catch (\Exception $e)
        {
            return $e;
        }
    }

    public function callServer($url){

        $apiUrl = 'http://127.0.0.1:5001/';
        //$apiML = $apiUrl . $url;
        $apiML = (env("ML_SERVER", "").':'.env("ML_PORT","").$url);
        //dd($apiML);
        try {

            $client = new Client();

            $response = $client->request('GET', $apiML, [
                'headers' => [
                    'Accept' => 'application/json',
                    //'Authorization' => 'Bearer TU_TOKEN', // Si la API requiere autenticación
                ]
            ]);

            //dd($response);

            return response()->json(json_decode($response->getBody(), true));

            /*$response = Http::withHeaders([
                'Accept' => 'application/json',
                //'Authorization' => 'Bearer TU_TOKEN',
                ])->get($apiML);

            $data = $response->json();

            return $data;*/
        }
        catch (\Exception $e)
        {
            return $e;

        }
    }
}
