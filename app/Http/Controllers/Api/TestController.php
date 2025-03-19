<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;


class TestController extends Controller
{
    //

    public function getActividades(Request $request){
        $id_actividad = $request->id_activity;

        $actividades = Activity::find($id_actividad);

        return$actividades;
    }
}
