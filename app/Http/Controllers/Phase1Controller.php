<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Hypotheses;
use App\Models\Limitation;
use App\Models\Member;
use App\Models\Project;
use App\Models\LaboratoryProject;
use App\Models\Scope;
use App\Models\SpecificGoal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class Phase1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('memla.phase1.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function provisional_project(Request $request){
        //dd('Hola');
        //dd($request->all());

        $user_id = Auth::id();
        $request->merge(['user_id' => $user_id]);   //De esta forma añado la propiedad user_id al request para despues poder validarlo

        //dd($request["user_id"]);
        $request->validate([
            "title_project" => 'required',
            "user_id" => "required",
        ]);

        //dd($request->title_project);
        $ifExist=Project::where([
            ["title",'=',$request->title_project],
            ["user_id",'=',$user_id],
        ])->first();

        if(!$ifExist) {
            //dd('No esta duplicado');
            $project = Project::create([
                "title" => $request->title_project,
                "user_id" => $user_id,
            ]);
        } else {
            //dd('El titulo ya ha sido tomado');
            return redirect()->back()->withErrors(['title' => 'This project title is already taken']);
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
            "title_project" =>"required|alpha_spaces",
            "problematic" =>"required|alpha_spaces",
            "justification" =>"required|alpha_spaces",
            "goal"=>"required|alpha_spaces",
        ]);

        try {

            $yourApiKey = getenv('OPENAI');
            $client = \OpenAI::client($yourApiKey);
            /*$client = \OpenAI::factory()
                ->withApiKey($yourApiKey)
                ->withOrganization('your-organization') // default: null
                ->withProject('Your Project') // default: null
                ->withBaseUri('openai.example.com/v1') // default: api.openai.com/v1
                ->withHttpClient($httpClient = new \GuzzleHttp\Client([])) // default: HTTP client found using PSR-18 HTTP Client Discovery
                ->withHttpHeader('X-My-Header', 'foo')
                ->withQueryParam('my-param', 'bar')
                ->withStreamHandler(fn (RequestInterface $request): ResponseInterface => $httpClient->send($request, [
                    'stream' => true // Allows to provide a custom stream handler for the http client.
                ]))
                ->make();*/
            //dd($client);
            $response = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are an academic researcher in artificial intelligence, an expert in machine learning, capable of drafting a research project protocol.
                     The following is the tittle of an investigation project that uses different technologies to achieve its objectives: '.$request->title_project.'.
                     The problem that the project seeks to solve is: '.$request->problematic.'.
                     The justification for the project is: '.$request->justification.'.
                     The main goal the proyect seek to achieve is: '.$request->goal.'.'],
                    ['role' => 'user', 'content' => 'Generate a hypothesis of just one paragraph for said project beginning with the phrase: it is possible.'],
                    ['role' => 'user', 'content' => 'Generate list of maximum 5 scopes for the project.'],
                    ['role' => 'user', 'content' => 'Generate a list of maximum 5 limitations for the project.'],
                    ['role' => 'user', 'content' => 'Generate the responses: hypothesis, scopes and limitations.generates the responses in json format with a key for each of the responses'],
                ],
            ]);
//dd($response);
            $result=$response['choices'][0]["message"]["content"];
            $result=str_replace('""','', $result);
            $result=str_replace(PHP_EOL,'',$result);
            $result=json_decode($result);
         //  dd($result);

            return redirect()->back()->with('result', $result)->withInput();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with('result', $e)->withInput();
        }

    }

    public function saveData(Request $request){

        //dd($request->all());
        $user_id = Auth::id();
        $request->merge(['user_id' => $user_id]);   //De esta forma añado la propiedad user_id al request para despues poder validarlo


        $request->validate([
            "title_project" => 'required|unique:projects,title|alpha_spaces',
            "problematic" => 'required|alpha_spaces',
            "justification" => 'required|alpha_spaces',
            //"have_results" => 'required',
            //"predict_behavior" => 'required',
            //"classify_data" => 'required',
            //"find_relationships" => 'required',
            "start_date" => 'required',
            "end_date" => 'required',
            "goal" => 'required|alpha_spaces',
            "definition_hypothesis" => 'required|alpha_spaces',
            "definition_scopes"=> 'required|alpha_spaces',
            "definition_limitations" => 'required|alpha_spaces',
            "activity"=>'required|array|min:2',
            "objective"=>"required|array|min:2",
            "activityStart"=>"required|array|min:2",
            "activityEnd"=>"required|array|min:2",
            "objective.*"=>"required|alpha_spaces",
            "activity.*"=>'required|alpha_spaces',
            "activityStart.*"=>"required",
            "activityEnd.*"=>"required",
            "user_id" => "required",
        ]);

        $start_date=Carbon::createFromFormat("m-d-Y",$request->start_date);
        $end_date=Carbon::createFromFormat("m-d-Y",$request->end_date);
       // dd($start_date);
        $ifExist=Project::where([
            ["title",'=',$request->title_project],
            ["describe_problem",'=',$request->problematic],
            ["describe_justification",'=',$request->justification],
            ["goal",'=',$request->goal],
           // ["start_date",'=',$request->start_date],
           // ["final_date",'=',$request->end_date],
            ["user_id",'=',$user_id],
        ])->first();
        //dd($ifExist);

        if(!$ifExist) {
            $project = Project::create([
                "title" => $request->title_project,
                "describe_problem" => $request->problematic,
                "describe_justification" => $request->justification,
                "goal" => $request->goal,
                "start_date" => $start_date,
                "final_date" => $end_date,
                "user_id" => $user_id,
            ]);

            $limitations = Limitation::firstOrCreate([
                "limitations_description" => $request->definition_limitations,
                "project_id" => $project->id,
            ]);
            $hypothesis = Hypotheses::firstOrCreate([
                "hypotesys_description" => $request->definition_hypothesis,
                "project_id" => $project->id,

            ]);
            $scopes = Scope::firstOrCreate([
                "scopes_description" => $request->definition_scopes,
                "project_id" => $project->id,

            ]);

            //divide la cadena en dos partes y toma la primera parte, el [0] es para acceder al primer elemento que se crea dentro del array
            $first_number = (int) explode('-', $request->number_members)[0];
            //dd($first_number);

            $members=Member::firstOrCreate([
                 "number_members"=>$first_number,
                 "project_id"=>$project->id,
            ]);


            foreach ($request->objective as $objective)
                $specificgoal = SpecificGoal::firstOrCreate([
                    "specifics_description" => $objective,
                    "project_id" => $project->id,

                ]);
            foreach ($request->activity as $key => $activity) {
                $start_date = Carbon::createFromFormat("m-d-Y", $request->activityStart[$key - 1]);
                $end_date = Carbon::createFromFormat("m-d-Y", $request->activityEnd[$key - 1]);
                Activity::create([
                    "activities_description" => $activity,
                    "start_date" => $start_date,
                    "final_date" => $end_date,
                    "project_id" => $project->id,
                ]);
            }
          //  dd($project->id."new");


        }
       // dd($ifExist->id."back");
        //dd('Error ');
        return redirect()->back()->with('project_id', $ifExist?$ifExist->id:$project->id)->withInput();

        //  $activities=Activity::create([
        //      "activities_description"=>$request->activity,
        //      "start_date"=>$start_date,
        //     "final_date"=>$end_date,
        //     "project_id"=>$project->id,

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //dd($id->all());

        $data = Project::find($id);
        $data->delete();

        return redirect()->route('project_memla.index')
            ->with('success', 'LaboratoryProject deleted successfully');
    }
}
