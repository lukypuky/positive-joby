<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Job;
use App\Models\Job_employment_type;
use App\Models\Employment_type;
use App\Models\Homeoffice;
use App\Models\Salary_type;
use Illuminate\Support\Facades\DB;
use App\Models\Reference;

class PageController extends Controller
{
    public function getIndex(){   
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
        $references = Reference::all();
        return view('/reference', ['references' => $references]);
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
        $order = $request->get('order');
        $experiencesArray = [];
        $homeofficesArray = [];
        $employmentTypesArray = [];
        $salaryFromArray = [];
        $salaryToArray = [];

        if($request->get('experiences'))
        {
            $experiences = Experience::select('id')->whereIn('name', $request->get('experiences'))->get();
            foreach($experiences as $experience){
                array_push($experiencesArray, $experience->id);
            }
        }

        if($request->get('homeoffices')){
            $homeoffices = Homeoffice::select('id')->whereIn('name', $request->get('homeoffices'))->get();
            foreach($homeoffices as $homeoffice){
                array_push($homeofficesArray, $homeoffice->id);
            }
        }

        if($request->get('employmentTypes')){
            $employmentTypes = Job_employment_type::select('id_job')->whereIn('id_employment_type', $request->get('employmentTypes'))->get();
            foreach($employmentTypes as $employmentType){
                array_push($employmentTypesArray, $employmentType->id_job);
            }
        }

        if($request->get('salaryFrom')){
            $jobSalaryFrom = Job::select('id')->where('salary_from', '>=', $request->get('salaryFrom'))->get();
            foreach($jobSalaryFrom as $salaryFrom){
                array_push($salaryFromArray, $salaryFrom->id);
            }
        }

        if($request->get('salaryTo')){
            $jobSalaryTo = Job::select('id')->where('salary_to', '<=', $request->get('salaryTo'))->get();
            foreach($jobSalaryTo as $salaryTo){
                array_push($salaryToArray, $salaryTo->id);
            }
        }

        // DB::enableQueryLog();
        if(!$salaryToArray){
            if($experiencesArray && !$homeofficesArray && !$employmentTypesArray && !$salaryFromArray){
                $jobs = Job::whereIn('id_experience', $experiencesArray)->get();
            }
            elseif (!$experiencesArray && $homeofficesArray && !$employmentTypesArray && !$salaryFromArray) {
                $jobs = Job::whereIn('id_homeoffice', $homeofficesArray)->get();
            }
            elseif (!$experiencesArray && !$homeofficesArray && $employmentTypesArray && !$salaryFromArray) {
                $jobs = Job::whereIn('id', $employmentTypesArray)->get();
            }
            elseif (!$experiencesArray && !$homeofficesArray && !$employmentTypesArray && $salaryFromArray) {
                $jobs = Job::whereIn('id', $salaryFromArray)->get();
            }
            elseif ($experiencesArray && $homeofficesArray && !$employmentTypesArray && !$salaryFromArray) {
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
                ->whereIn('id_homeoffice', $homeofficesArray)
                ->get();
            }
            elseif ($experiencesArray && !$homeofficesArray && $employmentTypesArray && !$salaryFromArray) {
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
                ->whereIn('id', $employmentTypesArray)
                ->get();
            }
            elseif ($experiencesArray && !$homeofficesArray && !$employmentTypesArray && $salaryFromArray) {
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
                ->whereIn('id', $salaryFromArray)
                ->get();
            }
            elseif ($experiencesArray && $homeofficesArray && $employmentTypesArray && !$salaryFromArray) {
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
                ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                ->whereIn('id', $employmentTypesArray)
                ->get();
            }
            elseif ($experiencesArray && $homeofficesArray && !$employmentTypesArray && $salaryFromArray) {
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
                ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                ->whereIn('id', $salaryFromArray)
                ->get();
            }
            elseif ($experiencesArray && !$homeofficesArray && $employmentTypesArray && $salaryFromArray) {
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
                ->whereIn('id', $employmentTypesArray, 'and')
                ->whereIn('id', $salaryFromArray)
                ->get();
            }
            elseif (!$experiencesArray && $homeofficesArray && $employmentTypesArray && !$salaryFromArray) {
                $jobs = Job::whereIn('id', $employmentTypesArray, 'or')
                ->whereIn('id_homeoffice', $homeofficesArray)
                ->get();
            }
            elseif (!$experiencesArray && !$homeofficesArray && $employmentTypesArray && $salaryFromArray) {
                $jobs = Job::whereIn('id', $employmentTypesArray, 'or')
                ->whereIn('id', $salaryFromArray)
                ->get();
            }
            elseif (!$experiencesArray && $homeofficesArray && $employmentTypesArray && $salaryFromArray) {
                $jobs = Job::whereIn('id', $employmentTypesArray, 'or')
                ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                ->whereIn('id', $salaryFromArray)
                ->get();
            }
            elseif (!$experiencesArray && $homeofficesArray && !$employmentTypesArray && $salaryFromArray) {
                $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')
                ->whereIn('id', $salaryFromArray)
                ->get();
            }
            elseif ($experiencesArray && $homeofficesArray && $employmentTypesArray && $salaryFromArray){ 
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
                ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                ->whereIn('id', $employmentTypesArray, 'and')
                ->whereIn('id', $$salaryFromArray)
                ->get();
            }
            else{
                $jobs = Job::orderBy('position_name', 'asc')->get();
            }
        }

        if($order == 2){
            $jobs = json_decode($jobs);

            $columns = array_column($jobs, 'position_name');
            array_multisort($columns, SORT_DESC, $jobs);
        }
        else{
            $jobs = json_decode($jobs);

            $columns = array_column($jobs, 'position_name');
            array_multisort($columns, SORT_ASC, $jobs);
        }

        // $query = DB::getQueryLog();
        // $query = end($query);
        // var_dump($query);
            
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $layoutType = $request->get('layout');

        return $this->renderLayout($layoutType, $jobs, $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes);        
    }

    public function getJob($slug)
    {
        $job = Job::where('slug', $slug)->firstOrfail();
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();

        return view('job',['job' => $job, 'salaryTypes' => $salaryTypes, 'allEmploymentTypes' => $allEmploymentTypes, 'jobEmploymentTypes' => $jobEmploymentTypeIds]);
    }
}
