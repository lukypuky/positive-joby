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
        // $jobs = Job::all()->paginate(8);
        return view('/index');
    }
}
