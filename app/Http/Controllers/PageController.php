<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Job;
use App\Models\Job_employment_type;
use App\Models\Employment_type;
use App\Models\Homeoffice;
use App\Models\Salary_type;

class PageController extends Controller
{
    public function getIndex()
    {   
        $jobs = Job::orderBy('position_name', 'asc')->get();
        $allEmploymentTypes = Employment_type::all();
        $experiences = Experience::all();
        $homeoffices = Homeoffice::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $this->renderLayout(2, $jobs, $jobEmploymentTypeIds, $allEmploymentTypes, $salaryTypes);

        return view('/index', ['jobs' => $jobs, 'allEmploymentTypes' => $allEmploymentTypes, 'experiences' => $experiences, 'homeoffices' => $homeoffices, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes]);
    }

    public function getContact(){
        
        return view('/contact');
    }

    public function getReference(){
        
        return view('/reference');
    }

    public function renderLayout($layoutType, $jobs, $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes){
        if($layoutType == 1){
            return view('tile', ['jobs' => $jobs, 'allEmploymentTypes' => $allEmploymentTypes, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes]); 
        }
        else{
            return view('row', ['jobs' => $jobs, 'allEmploymentTypes' => $allEmploymentTypes, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes]); 
        }
    }

    public function searchJobs(Request $request){
        
        $jobs = Job::where('position_name', 'like', '%' . $request->get('searchRequest') . '%')->get();
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $layoutType = $request->get('layout');

        return $this->renderLayout($layoutType, $jobs, $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes);
    }

    public function getJobLayout(Request $request){
        $jobs = Job::orderBy('position_name', 'asc')->get();
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $layoutType = $request->get('layout');

        return $this->renderLayout($layoutType, $jobs, $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes);
    }

    public function getJobsFiltred(Request $request)
    {
        $experiencesArray = [];
        $homeofficesArray = [];


        if($request->get('experiences'))
        {
            $experiences = Experience::select('id')->whereIn('name',$request->get('experiences'))->get();
            foreach($experiences as $experience)
            {
                array_push($experiencesArray, $experience->id);
            }
        }

        if($request->get('homeoffices')){
            $homeoffices = Homeoffice::select('id')->whereIn('name',$request->get('homeoffices'))->get();
            foreach($homeoffices as $homeoffice)
            {
                array_push($homeofficesArray, $homeoffice->id);
            }
        }
        

        // treba to pozriet a dokoncit whereIn whereHas
        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')->whereIn('id_homeoffice', $homeofficesArray)->get();
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $layoutType = $request->get('layout');

        return $this->renderLayout($layoutType, $jobs, $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes);
        // $meetings = DB::table('googlesheet')->whereIn('rollnumber1',$qTXT, 'or')->whereIn('rollnumber2',$qTXT, 'or')->whereIn('rollnumber3',$qTXT, 'or')->whereIn('rollnumber4',$qTXT, 'or')->toSql();
        
    }
}
