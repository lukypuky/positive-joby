<?php

namespace App\Orchid\Screens\Job;

use App\Models\Job;
use App\Models\Employment_type;
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

        return [
            'jobs' => $jobs,
            'employment_types' => $employment_types
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
                    ->render(function ($jobs, $employment_types) {
                        $tmp = Employment_type::select('name')->where('id', $jobs->id_employment_type)->get();
                        return $tmp;
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
                TD::make('Popis')
                    ->sort()
                    ->width('250px')
                    ->render(function ($jobs) {
                        return $jobs->description;
                    }),
                TD::make('Očakávania')
                    ->sort()
                    ->width('250px')
                    ->render(function ($jobs) {
                        return $jobs->expectation;
                    }),
                TD::make('Benefity')
                    ->sort()
                    ->width('250px')
                    ->render(function ($jobs) {
                        return $jobs->benefits;
                    }),
                TD::make('Akcie')
                    ->render(function (Job $jobs) {
                        return Link::make('')
                            ->icon('pencil')
                            ->route('platform.job.edit', $jobs);
                    }), 
            ])
        ];
    }
}
