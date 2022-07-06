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
        $jobs = Job::orderBy('position_name', 'asc')->paginate(8);
        $allEmplymentTypes = Employment_type::all();
        $experiences = Experience::all();
        $homeoffices = Homeoffice::all();
        $jobEmploymentTypeIds = Job_employment_type::all();
        $salaryTypes = Salary_type::all();

        return view('/index', ['jobs' => $jobs, 'allEmploymentTypes' => $allEmplymentTypes, 'experiences' => $experiences, 'homeoffices' => $homeoffices, 'jobEmploymentTypes' => $jobEmploymentTypeIds, 'salaryTypes' => $salaryTypes]);
    }

    public function searchJobs(Request $request){
        
        $searchedJobs = Job::where('position_name', 'like', '%' . $request->get('searchRequest') . '%')->get();
        $jobs = json_encode($searchedJobs);
        return $jobs;
    }

    public function getJobTiles(){
        
        echo "dacoTile";
    }
}
