<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dataset;
use App\Models\Models;
use App\Models\ModelsType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use function Laravel\Prompts\select;

class Phase4Controller extends Controller
{
    public function trainModel(Request $request){
        try {
            $data = array('algorithm' => $request->algorithm,
                'configuration' => $request->configuration,
                'test_dt' => $request->test_dt,
                'training_dt' => $request->training_dt,
                'laboratory_id' => $request->laboratory_id,
                'spliteType' => $request->spliteType,
                'target' => $request->target,
                'features' => $request->features,
            );

            #La respuesta que da el servidor no es un json ni un objeto, es un array asociativo por lo que hay que acceder a el como tal.
            $respuesta_de_servidor = $this->callServer("/train_model/?" . http_build_query($data));
            //$respuesta_de_servidor['path_test'];

            $id_test = Dataset::where('path', $respuesta_de_servidor['pathTest'])->value('id');
            $id_training = Dataset::where('path', $respuesta_de_servidor['pathTraining'])->value('id');
            $id_model_type = ModelsType::where('name', $respuesta_de_servidor['model_name'])->value('id');
            //dd($respuesta_de_servidor, $id_test, $id_training, $id_model_type);

            //busca registro con borrado suave
            $model_trashed = Models::withTrashed()
                ->where('model_path', $respuesta_de_servidor['path_model'])
                ->where('test_dataset_id', $id_test)
                ->where('training_dataset_id', $id_training)
                ->first();
            $model = "";
            //En caso de no encontrarlo, lo crea y borra
            if (!$model_trashed)
            {
                $model = Models::create([
                    'test_dataset_id' => $id_test,
                    'training_dataset_id' => $id_training,
                    'model_path' => $respuesta_de_servidor['path_model'],
                    'status' => 0,
                    'model_type_id' => $id_model_type
                ]);
                $model->delete(); // Borrado suave
                $model_trashed = "";
            }
            //Si existe sin borrado suave, lo borramos
            elseif(!$model_trashed->trashed())
                $model_trashed->delete();

            $model_to_save = $model_trashed ? $model_trashed : $model;

            return [$respuesta_de_servidor, $model_to_save];

        } catch (\Exception $e) {
            return $e;
        }
    }

    public function  saveModel(Request $request){
        try {
            //busccr registro con borrado suave
            $model_trashed = Models::withTrashed()
                ->where('model_path', $request['modelPath'])
                ->where('test_dataset_id', $request['pathTestid'])
                ->where('training_dataset_id',  $request['pathTrainingid'])
                ->first();

            if ($model_trashed) {
                if ($model_trashed->trashed()) {
                    // Si el modelo está borrado suavemente, lo restauro
                    $model_trashed->restore();
                }
            } else {
                // Si el modelo no existe, ni con borrado suave, lo creo
                $model = Models::create([
                    'test_dataset_id' => $request['pathTestid'],
                    'training_dataset_id' => $request['pathTrainingid'],
                    'model_path' => $request['modelPath'],
                    'status' => 0,
                    'model_type_id' => $request['modelTypeId'],
                ]);
            }

            $respuesta = ["Respuesta" => "Modelo guardado"];

            return response()->json($respuesta);

        }
        catch (\Exception $e){
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
