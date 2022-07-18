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
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use App\Models\Contact;
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
        // $experiencesArray = [];
        // $homeofficesArray = [];
        // $employmentTypesArray = [];
        // $salaryFromArray = [];
        // $salaryToArray = [];


        // if($request->get('experiences'))
        // {
        //     $experiences = Experience::select('id')->whereIn('name', $request->get('experiences'))->get();
        //     foreach($experiences as $experience){
        //         array_push($experiencesArray, $experience->id);
        //     }
        // }

        // if($request->get('homeoffices')){
        //     $homeoffices = Homeoffice::select('id')->whereIn('name', $request->get('homeoffices'))->get();
        //     foreach($homeoffices as $homeoffice){
        //         array_push($homeofficesArray, $homeoffice->id);
        //     }
        // }

        // if($request->get('employmentTypes')){
        //     $employmentTypes = Job_employment_type::select('id_job')->whereIn('id_employment_type', $request->get('employmentTypes'))->get();
        //     foreach($employmentTypes as $employmentType){
        //         array_push($employmentTypesArray, $employmentType->id_job);
        //     }
        // }

        // if($request->get('salaryFrom')){
        //     $jobSalaryFrom = Job::select('id')->where('salary_from', '>=', $request->get('salaryFrom'))->get();
        //     foreach($jobSalaryFrom as $salaryFrom){
        //         array_push($salaryFromArray, $salaryFrom->id);
        //     }
        // }

        // if($request->get('salaryTo')){
        //     $jobSalaryTo = Job::select('id')->where('salary_to', '<=', $request->get('salaryTo'))->get();
        //     foreach($jobSalaryTo as $salaryTo){
        //         array_push($salaryToArray, $salaryTo->id);
        //     }
        // }

        // switch($order){
        //     case 1:
        //         $jobs = Job::orderBy('position_name', 'asc')->get();
        //         break;
        //     case 2:
        //         $jobs = Job::orderBy('position_name', 'desc')->get();
        // }

        // DB::enableQueryLog();
        // if(!$salaryToArray){
        //     if($experiencesArray && !$homeofficesArray && !$employmentTypesArray && !$salaryFromArray){
        //         $jobs = Job::whereIn('id_experience', $experiencesArray)->get();
        //     }
        //     elseif (!$experiencesArray && $homeofficesArray && !$employmentTypesArray && !$salaryFromArray) {
        //         $jobs = Job::whereIn('id_homeoffice', $homeofficesArray)->get();
        //     }
        //     elseif (!$experiencesArray && !$homeofficesArray && $employmentTypesArray && !$salaryFromArray) {
        //         $jobs = Job::whereIn('id', $employmentTypesArray)->get();
        //     }
        //     elseif (!$experiencesArray && !$homeofficesArray && !$employmentTypesArray && $salaryFromArray) {
        //         $jobs = Job::whereIn('id', $salaryFromArray)->get();
        //     }
        //     elseif ($experiencesArray && $homeofficesArray && !$employmentTypesArray && !$salaryFromArray) {
        //         $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
        //         ->whereIn('id_homeoffice', $homeofficesArray)
        //         ->get();
        //     }
        //     elseif ($experiencesArray && !$homeofficesArray && $employmentTypesArray && !$salaryFromArray) {
        //         $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
        //         ->whereIn('id', $employmentTypesArray)
        //         ->get();
        //     }
        //     elseif ($experiencesArray && !$homeofficesArray && !$employmentTypesArray && $salaryFromArray) {
        //         $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
        //         ->whereIn('id', $salaryFromArray)
        //         ->get();
        //     }
        //     elseif ($experiencesArray && $homeofficesArray && $employmentTypesArray && !$salaryFromArray) {
        //         $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
        //         ->whereIn('id_homeoffice', $homeofficesArray, 'and')
        //         ->whereIn('id', $employmentTypesArray)
        //         ->get();
        //     }
        //     elseif ($experiencesArray && $homeofficesArray && !$employmentTypesArray && $salaryFromArray) {
        //         $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
        //         ->whereIn('id_homeoffice', $homeofficesArray, 'and')
        //         ->whereIn('id', $salaryFromArray)
        //         ->get();
        //     }
        //     elseif ($experiencesArray && !$homeofficesArray && $employmentTypesArray && $salaryFromArray) {
        //         $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
        //         ->whereIn('id', $employmentTypesArray, 'and')
        //         ->whereIn('id', $salaryFromArray)
        //         ->get();
        //     }
        //     elseif (!$experiencesArray && $homeofficesArray && $employmentTypesArray && !$salaryFromArray) {
        //         $jobs = Job::whereIn('id', $employmentTypesArray, 'or')
        //         ->whereIn('id_homeoffice', $homeofficesArray)
        //         ->get();
        //     }
        //     elseif (!$experiencesArray && !$homeofficesArray && $employmentTypesArray && $salaryFromArray) {
        //         $jobs = Job::whereIn('id', $employmentTypesArray, 'or')
        //         ->whereIn('id', $salaryFromArray)
        //         ->get();
        //     }
        //     elseif (!$experiencesArray && $homeofficesArray && $employmentTypesArray && $salaryFromArray) {
        //         $jobs = Job::whereIn('id', $employmentTypesArray, 'or')
        //         ->whereIn('id_homeoffice', $homeofficesArray, 'and')
        //         ->whereIn('id', $salaryFromArray)
        //         ->get();
        //     }
        //     elseif (!$experiencesArray && $homeofficesArray && !$employmentTypesArray && $salaryFromArray) {
        //         $jobs = Job::whereIn('id_homeoffice', $homeofficesArray, 'or')
        //         ->whereIn('id', $salaryFromArray)
        //         ->get();
        //     }
        //     elseif ($experiencesArray && $homeofficesArray && $employmentTypesArray && $salaryFromArray){ 
        //         $jobs = Job::whereIn('id_experience', $experiencesArray, 'or')
        //         ->whereIn('id_homeoffice', $homeofficesArray, 'and')
        //         ->whereIn('id', $employmentTypesArray, 'and')
        //         ->whereIn('id', $$salaryFromArray)
        //         ->get();
        //     }
        //     else{
                // $jobs = Job::orderBy('position_name', 'asc')->get();
        //     }
        // }

        //NEDOKONCENE/////////////////////////////////////////////////////////////

        if($order == 2){
            $jobsTmp = Job::all();
            $jobsTmp = json_decode($jobsTmp, true);
            arsort($jobsTmp);

            // $jobs = new Job();
            foreach($jobsTmp as $job=>$jobValue)
            {
                echo $jobValue . '!!!';
            }

            // $myJSON = json_encode($jobs);
            // return $myJSON;
            
        }
        else{
            $jobs = Job::orderBy('position_name', 'asc')->get();
        }

        // foreach($jobs as $x=>$x_value)
        // {
        //     echo "Key=" . $x . ", Value=" . $x_value;
        //     echo "<br>";
        // }
        return $jobs;

        // print_r($jobs);
        // print_r($resultArray);

        // return $kar;
        // uasort($resultArray, array($this ,'sortJobs'));

        // return $resultArray;

        // $query = DB::getQueryLog();
        // $query = end($query);
        // var_dump($query);
               
        //NEDOKONCENE/////////////////////////////////////////////////////////////

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

    public function sendMail(Request $request){
        $data = [
            'nameSurname' => $request->nameSurname,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
            'file' => $request->file('fileUpload')
        ];

        $input = $request->validate([
            'nameSurname' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:8'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => 'required',
            'conditions' => 'required',
        ]);

        if($request->file('fileUpload')){
            if($request->file('fileUpload')->getSize() > 10000000){
                return Redirect::back()->with('failEmail', 'Príloha musí mať menej ako 10MB.');
            }
        }

        $email = 'lukash.baca@gmail.com';
        \Mail::to("$email")->send(new ContactMail($data));

        Contact::create([
            'contact_type' => $request->get('formType'), 
            'id_job' => $request->get('job'),
            'name_surname' => $request->get('nameSurname'),
            'phone' => $request->get('phone'),
            'email' => $request->get('email'),
            'message' => $request->get('message'),
        ]);

        return Redirect::back()->with('successEmail', 'Žiadosť bola úspešne odoslaná.');
    }

    // public static function sortJobs($a, $b) {
    //     print_r($a["position_name"]).(' - ').print_r($b["position_name"]);
    //     return strcmp($a["position_name"], $b["position_name"]);
    // }
}
