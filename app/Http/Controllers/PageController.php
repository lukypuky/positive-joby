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
        $jobs = Job::all();
        $allEmplymentTypes = Employment_type::all();
        $experiences = Experience::all();
        $homeoffices = Homeoffice::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();

        // $jobEmploymentTypeIds = Job_employment_type::select('id_employment_type')->where('id_job', 15)->get();
        // $jobEmploymentTypes = array();

        // foreach($jobEmploymentTypeIds as $jobEmploymentTypeId)
        // {
        //     $employmentTypeName = Employment_type::select('name')->where('id', $jobEmploymentTypeId->id_employment_type)->get();
        //     array_push($jobEmploymentTypes, $employmentTypeName);
        // }

        // return $jobEmploymentTypes;

        return view('/index', ['jobs' => $jobs, 'allEmploymentTypes' => $allEmplymentTypes, 'experiences' => $experiences, 'homeoffices' => $homeoffices, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes]);
    }
}
