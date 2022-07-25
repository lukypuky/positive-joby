<?php

namespace App\Orchid\Screens\Job;

use App\Models\Job;
use App\Models\Experience;
use App\Models\Employment_type;
use App\Models\Job_employment_type;
use App\Models\Homeoffice;
use App\Models\Salary_type;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class JobListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $jobs = Job::paginate(10);
        $employment_types = Employment_type::all();
        $job_employment_types = Job_employment_type::all();

        return [
            'jobs' => $jobs,
            'employment_types' => $employment_types,
            'job_employment_types' => $job_employment_types
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Joby';
    }

    /**
    * The description is displayed on the user's screen under the heading
    */
    public function description(): ?string
    {
        return "Prehľad";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Pridať nový job')
                ->icon('plus')
                ->route('platform.job.create')
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            Layout::table('jobs',[
                TD::make('Názov Jobu')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($jobs) {
                        return $jobs->position_name;
                    }),
                TD::make('Slug')
                    ->sort()
                    ->render(function ($jobs) {
                        return $jobs->slug;
                    }),
                TD::make('Druh pracovného pomeru')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($jobs) {
                        $jobEmploymentType = Job_employment_type::where('id_job', $jobs->id)->get();

                        $jobEmploymentType = $jobEmploymentType->toJson();
                        $newJobEmploymentType = json_decode($jobEmploymentType);
                        $stringEmploymentType = '';
                        
                        foreach($newJobEmploymentType as $employmentType)
                        {
                            $tmp = Employment_type::select('name')->where('id', $employmentType->id_employment_type)->get();
                            
                            $tmp = $tmp->toJson();
                            $newtmp = json_decode($tmp);
                            $stringEmploymentType = $stringEmploymentType.$newtmp[0]->name.', ';
                        }

                        $stringEmploymentType."<br>";
                        return rtrim($stringEmploymentType,", ");
                    }),
                TD::make('Skúsenosti')
                ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($jobs) {
                        $experienceName = Experience::select('name')->where('id', $jobs->id_experience)->get();
                        $experienceName = $experienceName->toJson();
                        $newExperienceName = json_decode($experienceName);

                        return $newExperienceName[0]->name;
                   }),
                TD::make('Práca z domu')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($jobs) {
                        $homeofficeName = Homeoffice::select('name')->where('id', $jobs->id_homeoffice)->get();
                        $homeofficeName = $homeofficeName->toJson();
                        $newHomeofficeName = json_decode($homeofficeName);

                        return $newHomeofficeName[0]->name;
                   }),
                TD::make('Plat od')
                    ->sort()
                    ->render(function ($jobs) {
                        return $jobs->salary_from;
                    }),
                TD::make('Plat do')
                    ->sort()
                    ->render(function ($jobs) {
                        return $jobs->salary_to;
                    }),
                TD::make('Typ platu')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($jobs) {
                        $salaryTypeName = Salary_type::select('name')->where('id', $jobs->id_salary_type)->get();
                        $salaryTypeName = $salaryTypeName->toJson();
                        $newSalaryTypeName = json_decode($salaryTypeName);

                        return $newSalaryTypeName[0]->name;
                   }),
                
                // TD::make('Popis') //zakomentovane kvoli dlhym textom v nahlade
                //     ->sort()
                //     ->width('250px')
                //     ->render(function ($jobs) {
                //         return $jobs->description;
                //     }),
                TD::make('Mzdové podmienky')
                    ->sort()
                    ->width('250px')
                    ->render(function ($jobs) {
                        return $jobs->salary_conditions;
                    }),
                // TD::make('Očakávania') //zakomentovane kvoli dlhym textom v nahlade
                //     ->sort()
                //     ->width('250px')
                //     ->render(function ($jobs) {
                //         return $jobs->expectation;
                //     }),
                // TD::make('Benefity')
                //     ->sort()
                //     ->width('250px')
                //     ->render(function ($jobs) {
                //         return $jobs->benefits;
                //     }),
                TD::make('Akcie')
                    ->render(function ($jobs) {
                        return Link::make('')
                            ->icon('pencil')
                            ->route('platform.job.edit', $jobs);
                    }), 
            ])
        ];
    }
}
