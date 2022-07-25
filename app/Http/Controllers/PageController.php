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
use Illuminate\Database\Eloquent\Builder;

class PageController extends Controller
{
    public function getIndex(){   
        $jobs = Job::orderBy('position_name', 'asc')->get();
        $allEmploymentTypes = Employment_type::all();
        $experiences = Experience::all();
        $homeoffices = Homeoffice::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();

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
        if(is_array($jobs)){
            if(empty($jobs)){
                    return "Nenašli sa žiadne záznamy.";
            }
        }
        else{
            if($jobs->count() == 0){
                return "Nenašli sa žiadne záznamy.";
            }
        }

        if($layoutType == 1){
            return view('tile', ['jobs' => $jobs, 'allEmploymentTypes' => $allEmploymentTypes, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes]); 
        }
        else{
            return view('row', ['jobs' => $jobs, 'allEmploymentTypes' => $allEmploymentTypes, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes]); 
        }
    }

    public function searchJobs(Request $request){
        $order = $request->get('order');
        
        $searchedJobs = Job::where('position_name', 'like', '%' . $request->get('searchRequest') . '%')->orderBy('position_name', 'asc')->get();
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $layoutType = $request->get('layout');

        $jobs = $this->orderJobs($order, $searchedJobs);

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
            $jobSalaryTo = Job::select('id')
                ->where('salary_to', '<=', $request->get('salaryTo'))
                ->orWhere('salary_from', '<=', $request->get('salaryTo'))
                ->where('salary_to', '=', null)
                ->get();
            foreach($jobSalaryTo as $salaryTo){
                array_push($salaryToArray, $salaryTo->id);
            }
        }

        if(empty($request->get('salaryTo')) == true){
            $jobs = $this->filerJobsWithoutToSalary($experiencesArray, $homeofficesArray, $employmentTypesArray, $salaryFromArray);
        }
        else{
            $jobs = $this->filerJobsWithToSalary($experiencesArray, $homeofficesArray, $employmentTypesArray, $salaryFromArray, $salaryToArray);
        }

        $jobs = $this->orderJobs($order, $jobs);
            
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $layoutType = $request->get('layout');

        return $this->renderLayout($layoutType, $jobs, $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes);        
    }

    public function orderJobs($order, $jobs){
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

        return $jobs;
    }

    public function getJob($slug)
    {
        $job = Job::where('slug', $slug)->firstOrfail();
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();

        return view('job',['job' => $job, 'salaryTypes' => $salaryTypes, 'allEmploymentTypes' => $allEmploymentTypes, 'jobEmploymentTypes' => $jobEmploymentTypeIds]);
    }

    public function filerJobsWithToSalary($experiencesArray, $homeofficesArray, $employmentTypesArray, $salaryFromArray, $salaryToArray){
        if ($experiencesArray){
            if ($homeofficesArray){
                if ($employmentTypesArray){
                    if ($salaryFromArray){
                        if ($salaryToArray){
                            $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | druh | platOD | platDO
                                ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                                ->whereIn('id', $employmentTypesArray, 'and')
                                ->whereIn('id', $salaryFromArray, 'and')
                                ->whereIn('id', $salaryToArray)
                                ->get();
                        }
                        else{
                            $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | druh | platOD
                                ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                                ->whereIn('id', $employmentTypesArray, 'and')
                                ->whereIn('id', $salaryFromArray)
                                ->get();
                        }
                    }
                    elseif ($salaryToArray){
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | druh | platDO
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->get();
                    }
                    else{
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | druh
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $employmentTypesArray)
                            ->get();
                    }
                }
                elseif ($salaryFromArray) {
                    if ($salaryToArray) {
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | platOD | platDO
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->get();
                    }
                    else {
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | platOD 
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->get();
                    }
                }
                elseif ($salaryToArray) {
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | platDO 
                        ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->get();
                }
                else{
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice 
                        ->whereIn('id_homeoffice', $homeofficesArray)
                        ->get();
                }
            }
            elseif ($employmentTypesArray){
                if ($salaryFromArray) {
                    if ($salaryToArray) {
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | druh | platOD | platDO
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->get();
                    }
                    else {
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | druh | platOD
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray)
                            ->get();
                    }
                }
                elseif ($salaryToArray) {
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | druh | platDO
                        ->whereIn('id', $employmentTypesArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->get();
                }
                else {
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | druh
                        ->whereIn('id', $employmentTypesArray)
                        ->get();
                }
            }
            elseif ($salaryFromArray) {
                if ($salaryToArray){
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | platOD | platDO
                        ->whereIn('id', $salaryFromArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->get();
                }
                else {
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | platOD
                        ->whereIn('id', $salaryFromArray)
                        ->get();
                }
            }
            elseif ($salaryToArray) {
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | platDO
                    ->whereIn('id', $salaryToArray)
                    ->get();
            }
            else{
                $jobs = Job::whereIn('id_experience', $experiencesArray)->get();    //skusenosti 
            }
        }
        elseif ($homeofficesArray) {
            if ($employmentTypesArray) {
                if ($salaryFromArray) {
                    if ($salaryToArray) {
                        $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | druh | platOD | platDO
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->get();
                    }
                    else {
                        $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | druh | platOD
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray)
                            ->get();
                    }
                }
                elseif ($salaryToArray) {
                    $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | druh | platDO
                        ->whereIn('id', $employmentTypesArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->get();
                }
                else {
                    $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | druh
                        ->whereIn('id', $employmentTypesArray)
                        ->get();
                }
            }
            elseif ($salaryFromArray) {
                if ($salaryToArray) {
                    $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | platOD | platDO
                        ->whereIn('id', $salaryFromArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->get();
                }
                else {
                    $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | platOD
                        ->whereIn('id', $salaryFromArray)
                        ->get();
                }
            }
            elseif ($salaryToArray) {
                $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | platDO
                    ->whereIn('id', $salaryToArray)
                    ->get();
            }
            else {
                $jobs = Job::whereIn('id_homeoffice', $homeofficesArray)->get(); //homeoffice
            }
        }
        elseif ($employmentTypesArray) {
            if ($salaryFromArray) {
               if ($salaryToArray) {
                    $jobs = Job::whereIn('id', $employmentTypesArray, 'or')   //druh | platOD | platDO
                        ->whereIn('id', $salaryFromArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->get();
               }
               else {
                    $jobs = Job::whereIn('id', $employmentTypesArray, 'or')   //druh | platOD
                        ->whereIn('id', $salaryFromArray)
                        ->get();
               }
            }
            elseif ($salaryToArray) {
                $jobs = Job::whereIn('id', $employmentTypesArray, 'or')   //druh | platDO
                    ->whereIn('id', $salaryToArray)
                    ->get();
            }
            else {
                $jobs = Job::whereIn('id', $employmentTypesArray)->get(); //druh
            }
        }
        elseif ($salaryFromArray) {
            if ($salaryToArray) {
                $jobs = Job::whereIn('id', $salaryFromArray, 'or')  //platOD | platDO
                    ->whereIn('id', $salaryToArray)
                    ->get();
            }
            else {
                $jobs = Job::whereIn('id', $salaryFromArray)->get();    //platOD
            }
        }
        elseif ($salaryToArray) {
            $jobs = Job::whereIn('id', $salaryToArray)->get(); //platDO
        }
        else{
            $jobs = Job::orderBy('position_name', 'asc')->get();
        }

        return $jobs;
    }

    public function filerJobsWithoutToSalary($experiencesArray, $homeofficesArray, $employmentTypesArray, $salaryFromArray){
        if ($experiencesArray){
            if ($homeofficesArray){
                if ($employmentTypesArray){
                    if ($salaryFromArray){
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | druh | platOD
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray)
                            ->get();
                    }
                    else{
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')  //skusenosti | homeoffice | druh
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $employmentTypesArray)
                            ->get();
                    }
                }
                elseif ($salaryFromArray) {
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')  //skusenosti | homeoffice | platOD
                        ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                        ->whereIn('id', $salaryFromArray)
                        ->get();
                }
                else{
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')  //skusenosti | homeoffice
                        ->whereIn('id_homeoffice', $homeofficesArray)
                        ->get();
                }
            }
            elseif ($employmentTypesArray) {
                if($salaryFromArray){
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')  //skusenosti | druh | platOD
                        ->whereIn('id', $employmentTypesArray, 'and')
                        ->whereIn('id', $salaryFromArray)
                        ->get();
                }
                else{
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')  //skusenosti | druh 
                        ->whereIn('id', $employmentTypesArray)
                        ->get();
                }

            }
            elseif ($salaryFromArray) {
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')  //skusenosti | platOD
                    ->whereIn('id', $salaryFromArray)
                    ->get();
            }
            else{
                $jobs = Job::whereIn('id_experience', $experiencesArray)->get();    //skusenosti 
            }
        }
        elseif ($homeofficesArray) {
            if ($employmentTypesArray) {
                if($salaryFromArray){
                    $jobs = Job::whereIn('id', $employmentTypesArray, 'or') //homeoffice | druh | platOD
                        ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                        ->whereIn('id', $salaryFromArray)
                        ->get();
                }
                else{
                    $jobs = Job::whereIn('id', $employmentTypesArray, 'or') //homeoffice | druh
                        ->whereIn('id_homeoffice', $homeofficesArray)
                        ->get();
                }
            }
            elseif ($salaryFromArray){
                $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')  //homeoffice | platOD
                    ->whereIn('id', $salaryFromArray)
                    ->get();
            }
            else{
                $jobs = Job::whereIn('id_homeoffice', $homeofficesArray)->get(); //homeoffice
            }
        }
        elseif ($employmentTypesArray){
            if($salaryFromArray){
                $jobs = Job::whereIn('id', $employmentTypesArray, 'or') //druh | platOD
                    ->whereIn('id', $salaryFromArray)
                    ->get();
            }
            else{
                $jobs = Job::whereIn('id', $employmentTypesArray)->get(); //druh
            }
        }
        elseif ($salaryFromArray) {
            $jobs = Job::whereIn('id', $salaryFromArray)->get();    //platOD
        }
        else{
            $jobs = Job::orderBy('position_name', 'asc')->get(); //all
        }

        return $jobs;
    }
}
