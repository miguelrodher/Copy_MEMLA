<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class Phase3Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(string $id)
    {
        //
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

    public function ComprobarYGuardar($respuesta_de_servidor, $tipe_test, $tipe_training)
    {
        $test_trashed = Dataset::onlyTrashed()
            ->where('path', $respuesta_de_servidor['path_test'])
            ->where('laboratory_id', $respuesta_de_servidor['laboratoryId'])
            ->where('type_id', $tipe_test)
            ->first();
        if ($test_trashed)
            $test_trashed->restore(); // Restaura el registro eliminado en caso de encontrarlo
        else{
            #Buscamos el dataset para comprobar que exista el registro en la base
            $test = Dataset::where('path',$respuesta_de_servidor['path_test'])
                ->where('laboratory_id',$respuesta_de_servidor['laboratoryId'])
                ->where('type_id',$tipe_test)
                ->first();
            //Guardamos en base en caso de que no se encuentre el dataset buscado
            if($test == null){
                $test_create = new Dataset();
                $test_create->path = $respuesta_de_servidor['path_test'];
                $test_create->laboratory_id = $respuesta_de_servidor['laboratoryId'];
                $test_create->status = 0;
                $test_create->type_id = $tipe_test;
                $test_create->save();
                //dd($test_create);
            }
        }

        $training_trashed = Dataset::onlyTrashed()
            ->where('path', $respuesta_de_servidor['path_training'])
            ->where('laboratory_id', $respuesta_de_servidor['laboratoryId'])
            ->where('type_id', $tipe_training)
            ->first();
        if($training_trashed)
            $training_trashed->restore();
        else {
            $training = Dataset::where('path', $respuesta_de_servidor['path_training'])
                ->where('laboratory_id', $respuesta_de_servidor['laboratoryId'])
                ->where('type_id', $tipe_training)
                ->first();
            //dd($test, $training);
            if ($training == null) {
                $training_create = new Dataset();
                $training_create->path = $respuesta_de_servidor['path_training'];
                $training_create->laboratory_id = $respuesta_de_servidor['laboratoryId'];
                $training_create->status = 0;
                $training_create->type_id = $tipe_training;
                $training_create->save();
                //dd($training_create);
            }
        }
    }

    public function splitData(Request $request)
    {
        try {
            $data = array('titulo' => $request->title_project,
                'name_file' => $request->name_file,
                'testPercentage' => $request->testPercentage,
                'laboratoryId' => $request->laboratoryId,
            );

            #La respuesta que da el servidor no es un json ni un objeto, es un array asociativo por lo que hay que acceder a el como tal.
            $respuesta_de_servidor = $this->callServer("/split_data/?" . http_build_query($data));
            //dd($respuesta_de_servidor);
            $tipe_test = 3;
            $tipe_training = 4;

            $this->ComprobarYGuardar($respuesta_de_servidor, $tipe_test, $tipe_training);
            return $respuesta_de_servidor;

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function splitRepresentative(Request $request)
    {
        try {
            $data = array('titulo' => $request->title_project,
                'name_file' => $request->name_file,
                'confidenceLevel' => $request->confidenceLevel,
                'marginError' => $request->marginError,
                'laboratoryId' => $request->laboratoryId,
            );

            #La respuesta que da el servidor no es un json ni un objeto, es un array asociativo por lo que hay que acceder a el como tal.
            $respuesta_de_servidor = $this->callServer("/split_representative/?" . http_build_query($data));
            //dd($respuesta_de_servidor);
            $tipe_test = 5;
            $tipe_training = 6;

            $this->ComprobarYGuardar($respuesta_de_servidor, $tipe_test, $tipe_training);
            return $respuesta_de_servidor;

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function splitKFold(Request $request){
        try {
            $data = array('titulo' => $request->title_project,
                'name_file' => $request->name_file,
                'crossValidation' => $request->crossValidation,
                'laboratoryId' => $request->laboratoryId,
            );

            #La respuesta que da el servidor no es un json ni un objeto, es un array asociativo por lo que hay que acceder a el como tal.
            $respuesta_de_servidor = $this->callServer("/split_k_fold/?" . http_build_query($data));
            //dd($respuesta_de_servidor);
            $tipe_test = 7;
            $tipe_training = 8;

            $this->ComprobarYGuardar($respuesta_de_servidor, $tipe_test, $tipe_training);
            return $respuesta_de_servidor;

        } catch (\Exception $e) {
            return $e;
        }
    }




    public function callServer($url){

        $apiUrl = 'http://127.0.0.1:5001/';
        //$apiML = $apiUrl . $url;
        $apiML = (env("ML_SERVER", "").':'.env("ML_PORT","").$url);
        try {
            $response = Http::get($apiML);

            $data = $response->json();

            return $data;
        }
        catch (\Exception $e)
        {
            return $e;

        }
    }
}
