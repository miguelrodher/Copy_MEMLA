<?php

namespace App\Http\Controllers;


use App\Http\Traits\PDFTemplate;
use App\Models\Activity;
use App\Models\Hypotheses;
use App\Models\Limitation;
use App\Models\Member;
use App\Models\Project;
use App\Models\Scope;
use App\Models\SpecificGoal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MakePDFController extends Controller
{
    //
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new PDFTemplate('P','mm','Letter');
    }
    public function phase1(Request $request, Project $project)
    {
        $this->fpdf->SetFont('Times', 'B', 10);
        $this->fpdf->AliasNbPages();
        $this->fpdf->AddPage("P");
        $this->fpdf->SetMargins(20,20,);

        //260 max wight
        $this->fpdf->SetX(20);

        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(25,8,'Title Project: ',0,0,'L');
        $this->fpdf->SetFont('Times', '', 10);
        $this->fpdf->MultiCell(150,8,utf8_decode($project->title),0,'J',0);
        // $this->fpdf->Ln();
        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(25,8,'Problematic: ',0,0,'L');
        $this->fpdf->SetFont('');
        $this->fpdf->MultiCell(150,8,utf8_decode($project->describe_problem),0,'J',0);
        //$this->fpdf->Ln();
        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(25,8,'Justification: ',0,0,'L');
        $this->fpdf->SetFont('');
        $this->fpdf->MultiCell(150,8,utf8_decode($project->describe_justification),0,'J',0);

        /*
        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(70,10,'Exist examples of input data and results: ',0,0,'L');
        $this->fpdf->SetFont('','');
        $this->fpdf->Cell(20,10,utf8_decode($request["have_results"]),0,0,'L');

        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(70,10,'Predict the behavior of a phenomenon: ',0,0,'L');
        $this->fpdf->SetFont('','');
        $this->fpdf->Cell(20,10,utf8_decode(("No")),0,0,'L');

        $this->fpdf->Ln();
        $this->fpdf->SetFont('','B');

        $this->fpdf->Cell(70,10,'Find relationships in the data: ',0,0,'L');
        $this->fpdf->SetFont('','');
        $this->fpdf->Cell(20,10,utf8_decode(("No")),0,0,'L');

        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(70,10,'Classify data: ',0,0,'L');
        $this->fpdf->SetFont('','');
        $this->fpdf->Cell(70,10,utf8_decode(("No")),0,0,'L');
*/
        //  $this->fpdf->Ln();
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Times', 'B', 10);

        $this->fpdf->SetX(30);
        $this->fpdf->Cell(50,10,' Number of members of the task force',0,0,'C');
        $this->fpdf->Cell(50,10,'Start date of project',0,0,'C');
        $this->fpdf->Cell(60,10,'End date of project',0,0,'C');
        $this->fpdf->Ln();
        $this->fpdf->SetX(27);
        $this->fpdf->SetFont('','');

        //****Revisar el numero de miembros que se guarda desde la vista y consultarlo aqui***//
        $members=Member::where("project_id",$project->id)->first();

        if ($members->number_members == 1) {
            $range = "1-5";
        } elseif ($members->number_members == 6) {
            $range = "6-10";
        } elseif ($members->number_members == 11) {
            $range = "11-15";
        } elseif ($members->number_members == 16) {
            $range = "16-20";
        }

        $this->fpdf->Cell(62, 10, $range, 0, 0, 'L');
        $this->fpdf->Cell(56,10,$project->start_date,0,0,'L');
        $this->fpdf->Cell(50,10,$project->final_date,0,0,'L');

        //$this->fpdf->Cell(120,10,'Find relationships in the data: '.($request->relationships?$request->relationships:"No"),1,0,'L');
        $this->fpdf->Ln();
        $this->fpdf->SetX(20);
        //$this->fpdf->Ln();
        // $this->fpdf->SetFont('Arial', 'B', 12);
        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(25,8,'Goal: ',0,0,'L');
        $this->fpdf->SetFont('');
        $this->fpdf->MultiCell(150,8,utf8_decode($project->goal),0,'J',0);

        $this->fpdf->Ln();
        $objetives="";
        $allObjectives=SpecificGoal::where("project_id",$project->id)->pluck("specifics_description");
        foreach ($allObjectives as $value)
        {
            $objetives=$objetives.$value."\n";
        }
        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(25,8,'Objetives: ',0,0,'L');
        $this->fpdf->SetFont('');
        $this->fpdf->MultiCell(150,8,$objetives,0,'J',0);
        $this->fpdf->Ln();

        $hypotesis=Hypotheses::where("project_id",$project->id)->first();
        $scopes=Scope::where("project_id",$project->id)->first();
        $limitations=Limitation::where("project_id",$project->id)->first();
        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(25,8,'Hypothesis: ',0,0,'L');
        $this->fpdf->SetFont('');
        $this->fpdf->MultiCell(150,8,utf8_decode($hypotesis->hypotesys_description),0,'J',0);
        $this->fpdf->Ln();
        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(25,8,'Scopes: ',0,0,'L');
        $this->fpdf->SetFont('');
        $this->fpdf->MultiCell(150,8,utf8_decode($scopes->scopes_description),0,'J',0);
        $this->fpdf->Ln();
        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(25,8,'Limitations: ',0,0,'L');
        $this->fpdf->SetFont('');
        $this->fpdf->MultiCell(150,8,utf8_decode($limitations->limitations_description),0,'J',0);
        $this->fpdf->Ln();

        $activities="";

        $this->fpdf->SetFont('','B');
        $this->fpdf->Cell(25,8,'Schedule of activities: ',0,0,'L');
        $this->fpdf->Ln();
        $this->fpdf->SetFont('','');

        $this->fpdf->Cell(120,8,'Activities ',0,0,'L');
        $this->fpdf->Cell(40,8,'Start Date',0,0,'L');
        $this->fpdf->Cell(40,8,'End Date ',0,0,'L');

        $allActivities=Activity::where("project_id",$project->id)->get();
        foreach ($allActivities as $value)
        {
            $this->fpdf->Ln();
            $this->fpdf->Cell(120,8,utf8_decode($value->activities_description),0,0,'L');
            $this->fpdf->Cell(40,8,$value->start_date,0,0,'L');
            $this->fpdf->Cell(40,8,$value->final_date,0,0,'L');
        }

        //$this->fpdf->Text(10, 10, "Hello Wor");
        $this->fpdf->Output('','memla.pdf');

        exit;
    }
}

