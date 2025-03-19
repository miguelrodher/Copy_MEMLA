<?php

namespace App\Http\Controllers;

use App\Models\Dataset;
use App\Models\Project;
use App\Models\LaboratoryProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProjectMemlaController
 * @package App\Http\Controllers
 */
class ProjectMemlaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::id();
        $projects = Project::where('user_id',$id)->select('projects.*')->get();

        //dd($id);
        //Mapeo para que los proyectos de prueba estén dentro del proyecto principal y despues mapeo de los datasets dentro de cada proyecto de prueba
        $projects->map(function ($project){
            $projectMemlas = LaboratoryProject::where('project_id',$project->id)->get();

            $projectMemlas->map(function ($projectMemla){
                $dataset = Dataset::where('laboratory_id',$projectMemla->id)
                    ->where('type_id',1)
                    ->get();

                $projectMemla->dataset = $dataset;
                return $projectMemla;
            });         //En las lineas arriba de los return se está haciendo lo mismo, asignar una nueva propiedad a la variable principal

            $project['projectMemlas'] = $projectMemlas;
            return $project;
        });

        //dd($projects->all(),$id);

        return view('memla.phase2.project_memla.index', compact('projects'));
            //->with('i', (request()->input('page', 1) - 1) * $projectMemlas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //dd($id);
        $mainproject = Project::where('id', $id)->first();
        //dd($mainproject);

        $projectMemla = new LaboratoryProject();
        return view('memla.phase2.project_memla.create', compact('projectMemla','id','mainproject'))->with('success', 'Project Memla as created successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        //dd($request->all());
        request()->validate(LaboratoryProject::$rules);

        LaboratoryProject::create($request->all());
       return redirect()->route('project_memla.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projectMemla = LaboratoryProject::find($id);

        return view('memla.phase2.project_memla.show', compact('projectMemla'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectMemla = LaboratoryProject::find($id);

        return view('memla.phase2.project_memla.edit', compact('projectMemla'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  LaboratoryProject $projectMemla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LaboratoryProject $projectMemla)
    {
        request()->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $projectMemla->update($request->all());

        return redirect()->route('project_memla.index')
            ->with('success', 'LaboratoryProject updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(LaboratoryProject $project_memla)
    {
        $project_memla->delete();
        return redirect()->route('project_memla.index')
            ->with('success', 'LaboratoryProject deleted successfully');
    }

    public function restar_test_project($id_test_project)
    {
        $dataset = Dataset::where('laboratory_id',$id_test_project)->get();
        //dd($dataset);

        foreach ($dataset as $data){
            $data->delete();
        }

        return redirect()->back()
            ->with('success', 'LaboratoryProject restated successfully');
    }
}
