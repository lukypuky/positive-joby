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
        $allEmploymentTypes = Employment_type::all();
        $experiences = Experience::all();
        $homeoffices = Homeoffice::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();

        return view('/index', ['allEmploymentTypes' => $allEmploymentTypes, 'experiences' => $experiences, 'homeoffices' => $homeoffices, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes]);
    }

    public function getContact(){
        return view('/contact');
    }

    public function getReference(){
        $references = Reference::all();
        return view('/reference', ['references' => $references]);
    }

    public function renderLayout($layoutType, $jobs, $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes){
        if(is_array($jobs[1])){
            if(empty($jobs[1])){
                    return "Nenašli sa žiadne záznamy.";
            }
        }
        else{
            if($jobs[1]->count() == 0){
                return "Nenašli sa žiadne záznamy.";
            }
        }

        if($layoutType == 1){
            return view('tile', ['jobs' => $jobs[1], 'allEmploymentTypes' => $allEmploymentTypes, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes, 'count' => $jobs[0], 'page' => $jobs[2]]); 
        }
        else{
            return view('row', ['jobs' => $jobs[1], 'allEmploymentTypes' => $allEmploymentTypes, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes, 'count' => $jobs[0], 'page' => $jobs[2]]); 
        }
    }
    
    public function searchJobs(Request $request){
        $order = $request->get('order');
        $page = $request->get('page');
        $offset = ($page - 1) * 10;
        $count = 0;

        $orderType = '';

        if($order == 2){
            $orderType = 'desc';
        }
        else{
            $orderType = 'asc';
        }
        
        $searchedJobs = Job::where('position_name', 'like', '%' . $request->get('searchRequest') . '%')
            ->orderBy('position_name', $orderType)
            ->offset($offset)
            ->limit(10)
            ->get();

        $count = Job::where('position_name', 'like', '%' . $request->get('searchRequest') . '%')
            ->count();

        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $layoutType = $request->get('layout');

        return $this->renderLayout($layoutType, array($count, $jobs, $page), $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes);
    }

    public function getJobLayout(Request $request){
        $page =  $request->get('page');
        $offset = ($page - 1) * 10;
        $count = 0;

        $jobs = Job::orderBy('position_name', 'asc')                      
            ->offset($offset)
            ->limit(10)
            ->get();

        $count = Job::all()
            ->count();

        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $layoutType = $request->get('layout');

        return $this->renderLayout($layoutType, array($count, $jobs, $page), $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes);
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

            if(empty($employmentTypesArray)){
                return "Nenašli sa žiadne záznamy.";
            }
        }

        if($request->get('salaryFrom')){
            $jobSalaryFrom = Job::select('id')->where('salary_from', '>=', $request->get('salaryFrom'))->get();
            foreach($jobSalaryFrom as $salaryFrom){
                array_push($salaryFromArray, $salaryFrom->id);
            }

            if(empty($salaryFromArray)){
                return "Nenašli sa žiadne záznamy.";
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

        $jobsArray = $this->filterJobs($experiencesArray, $homeofficesArray, $employmentTypesArray, $salaryFromArray, $salaryToArray, $request->get('page'), $order);
            
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();
        $layoutType = $request->get('layout');

        return $this->renderLayout($layoutType, $jobsArray, $allEmploymentTypes, $jobEmploymentTypeIds, $salaryTypes);        
    }

    public function getJob($slug)
    {
        $job = Job::where('slug', $slug)->firstOrfail();
        $allEmploymentTypes = Employment_type::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();

        return view('job',['job' => $job, 'salaryTypes' => $salaryTypes, 'allEmploymentTypes' => $allEmploymentTypes, 'jobEmploymentTypes' => $jobEmploymentTypeIds]);
    }

    public function filterJobs($experiencesArray, $homeofficesArray, $employmentTypesArray, $salaryFromArray, $salaryToArray, $page = 1, $order){
        $offset = ($page - 1) * 10;
        $count = 0;
        $orderType = '';

        if($order == 2){
            $orderType = 'desc';
        }
        else{
            $orderType = 'asc';
        }

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
                                ->orderBy('position_name', $orderType)
                                ->offset($offset)
                                ->limit(10)
                                ->get();

                            $count = Job::whereIn('id_experience', $experiencesArray, 'or')   
                                ->whereIn('id', $employmentTypesArray, 'and')
                                ->whereIn('id', $salaryFromArray, 'and')
                                ->whereIn('id', $salaryToArray)
                                ->count();
                        }
                        else{
                            $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | druh | platOD
                                ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                                ->whereIn('id', $employmentTypesArray, 'and')
                                ->whereIn('id', $salaryFromArray)
                                ->orderBy('position_name', $orderType)
                                ->offset($offset)
                                ->limit(10)
                                ->get();

                            $count = Job::whereIn('id_experience', $experiencesArray, 'or')  
                                ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                                ->whereIn('id', $employmentTypesArray, 'and')
                                ->whereIn('id', $salaryFromArray)
                                ->count();
                        }
                    }
                    elseif ($salaryToArray){
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | druh | platDO
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->orderBy('position_name', $orderType)
                            ->offset($offset)
                            ->limit(10)
                            ->get();

                        $count = Job::whereIn('id_experience', $experiencesArray, 'or')
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->count();
                    }
                    else{
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | druh
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $employmentTypesArray)
                            ->orderBy('position_name', $orderType)
                            ->offset($offset)
                            ->limit(10)
                            ->get();

                        $count = Job::whereIn('id_experience', $experiencesArray, 'or') 
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $employmentTypesArray)
                            ->count();
                    }
                }
                elseif ($salaryFromArray) {
                    if ($salaryToArray) {
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | platOD | platDO
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->orderBy('position_name', $orderType)
                            ->offset($offset)
                            ->limit(10)
                            ->get();

                        $count = Job::whereIn('id_experience', $experiencesArray, 'or')
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->count();
                    }
                    else {
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | platOD 
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->orderBy('position_name', $orderType)
                            ->offset($offset)
                            ->limit(10)
                            ->get();

                        $count = Job::whereIn('id_experience', $experiencesArray, 'or') 
                            ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->count();
                    }
                }
                elseif ($salaryToArray) {
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice | platDO 
                        ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_experience', $experiencesArray, 'or') 
                        ->whereIn('id_homeoffice', $homeofficesArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->count();
                }
                else{
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | homeoffice 
                        ->whereIn('id_homeoffice', $homeofficesArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_experience', $experiencesArray, 'or')   
                        ->whereIn('id_homeoffice', $homeofficesArray)
                        ->count();
                }
            }
            elseif ($employmentTypesArray){
                if ($salaryFromArray) {
                    if ($salaryToArray) {
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | druh | platOD | platDO
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->orderBy('position_name', $orderType)
                            ->offset($offset)
                            ->limit(10)
                            ->get();

                        $count = Job::whereIn('id_experience', $experiencesArray, 'or') 
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->count();
                    }
                    else {
                        $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | druh | platOD
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray)
                            ->orderBy('position_name', $orderType)
                            ->offset($offset)
                            ->limit(10)
                            ->get();

                        $count = Job::whereIn('id_experience', $experiencesArray, 'or') 
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray)
                            ->count();
                    }
                }
                elseif ($salaryToArray) {
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | druh | platDO
                        ->whereIn('id', $employmentTypesArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_experience', $experiencesArray, 'or')   
                        ->whereIn('id', $employmentTypesArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->count();
                }
                else {
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | druh
                        ->whereIn('id', $employmentTypesArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_experience', $experiencesArray, 'or') 
                        ->whereIn('id', $employmentTypesArray)
                        ->count();
                }
            }
            elseif ($salaryFromArray) {
                if ($salaryToArray){
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | platOD | platDO
                        ->whereIn('id', $salaryFromArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_experience', $experiencesArray, 'or') 
                        ->whereIn('id', $salaryFromArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->count();
                }
                else {
                    $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | platOD
                        ->whereIn('id', $salaryFromArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_experience', $experiencesArray, 'or') 
                        ->whereIn('id', $salaryFromArray)
                        ->count();
                }
            }
            elseif ($salaryToArray) {
                $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')   //skusenosti | platDO
                    ->whereIn('id', $salaryToArray)
                    ->orderBy('position_name', $orderType)
                    ->offset($offset)
                    ->limit(10)
                    ->get();

                $count = Job::whereIn('id_experience', $experiencesArray, 'or')  
                    ->whereIn('id', $salaryToArray)
                    ->count();
            }
            else{
                $jobs = Job::whereIn('id_experience', $experiencesArray)    //skusenosti          
                    ->orderBy('position_name', $orderType)                
                    ->offset($offset)
                    ->limit(10)
                    ->get();   
                    
                $count = Job::whereIn('id_experience', $experiencesArray)     
                    ->count();
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
                            ->orderBy('position_name', $orderType)
                            ->offset($offset)
                            ->limit(10)
                            ->get();

                        $count = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray, 'and')
                            ->whereIn('id', $salaryToArray)
                            ->count();
                    }
                    else {
                        $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | druh | platOD
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray)
                            ->orderBy('position_name', $orderType)
                            ->offset($offset)
                            ->limit(10)
                            ->get();

                        $count = Job::whereIn('id_homeoffice', $homeofficesArray, 'or') 
                            ->whereIn('id', $employmentTypesArray, 'and')
                            ->whereIn('id', $salaryFromArray)
                            ->count();
                    }
                }
                elseif ($salaryToArray) {
                    $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | druh | platDO
                        ->whereIn('id', $employmentTypesArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_homeoffice', $homeofficesArray, 'or') 
                        ->whereIn('id', $employmentTypesArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->count();
                }
                else {
                    $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | druh
                        ->whereIn('id', $employmentTypesArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')  
                        ->whereIn('id', $employmentTypesArray)
                        ->count();
                }
            }
            elseif ($salaryFromArray) {
                if ($salaryToArray) {
                    $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | platOD | platDO
                        ->whereIn('id', $salaryFromArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   
                        ->whereIn('id', $salaryFromArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->count();
                }
                else {
                    $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | platOD
                        ->whereIn('id', $salaryFromArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')  
                        ->whereIn('id', $salaryFromArray)
                        ->count();
                }
            }
            elseif ($salaryToArray) {
                $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   //homeoffice | platDO
                    ->whereIn('id', $salaryToArray)
                    ->orderBy('position_name', $orderType)
                    ->offset($offset)
                    ->limit(10)
                    ->get();

                $count = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')   
                    ->whereIn('id', $salaryToArray)
                    ->count();
            }
            else {
                $jobs = Job::whereIn('id_homeoffice', $homeofficesArray)    //homeoffice   
                    ->orderBy('position_name', $orderType)                             
                    ->offset($offset)
                    ->limit(10)
                    ->get();

                $count = Job::whereIn('id_homeoffice', $homeofficesArray)     
                    ->count();
            }
        }
        elseif ($employmentTypesArray) {
            if ($salaryFromArray) {
               if ($salaryToArray) {
                    $jobs = Job::whereIn('id', $employmentTypesArray, 'or')   //druh | platOD | platDO
                        ->whereIn('id', $salaryFromArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id', $employmentTypesArray, 'or')  
                        ->whereIn('id', $salaryFromArray, 'and')
                        ->whereIn('id', $salaryToArray)
                        ->count();
               }
               else {
                    $jobs = Job::whereIn('id', $employmentTypesArray, 'or')   //druh | platOD
                        ->whereIn('id', $salaryFromArray)
                        ->orderBy('position_name', $orderType)
                        ->offset($offset)
                        ->limit(10)
                        ->get();

                    $count = Job::whereIn('id', $employmentTypesArray, 'or')   
                        ->whereIn('id', $salaryFromArray)
                        ->count();
               }
            }
            elseif ($salaryToArray) {
                $jobs = Job::whereIn('id', $employmentTypesArray, 'or')   //druh | platDO
                    ->whereIn('id', $salaryToArray)
                    ->orderBy('position_name', $orderType)
                    ->offset($offset)
                    ->limit(10)
                    ->get();

                $count = Job::whereIn('id', $employmentTypesArray, 'or')   
                    ->whereIn('id', $salaryToArray)
                    ->count();

            }
            else {
                $jobs = Job::whereIn('id', $employmentTypesArray)   //druh
                    ->orderBy('position_name', $orderType)
                    ->offset($offset)
                    ->limit(10)
                    ->get();

                $count = Job::whereIn('id', $employmentTypesArray)   
                    ->count();
            }
        }
        elseif ($salaryFromArray) {
            if ($salaryToArray) {
                $jobs = Job::whereIn('id', $salaryFromArray, 'or')  //platOD | platDO
                    ->whereIn('id', $salaryToArray)
                    ->orderBy('position_name', $orderType)
                    ->offset($offset)
                    ->limit(10)
                    ->get();

                $count = Job::whereIn('id', $salaryFromArray, 'or') 
                    ->whereIn('id', $salaryToArray)
                    ->count();
            }
            else {
                $jobs = Job::whereIn('id', $salaryFromArray)    //platOD
                    ->orderBy('position_name', $orderType)
                    ->offset($offset)
                    ->limit(10)
                    ->get();

                $count = Job::whereIn('id', $salaryFromArray)    
                    ->count();
            }
        }
        elseif ($salaryToArray) {
            $jobs = Job::whereIn('id', $salaryToArray)  //platDO
                ->orderBy('position_name', $orderType)
                ->offset($offset)
                ->limit(10)
                ->get();

                $count = Job::whereIn('id', $salaryToArray) 
                ->count();
        }
        else{
            $jobs = Job::orderBy('position_name', $orderType)
                ->offset($offset)
                ->limit(10)
                ->get();

            $count = Job::all()
                ->count();
        }

        return array($count, $jobs, $page);
    }
}
