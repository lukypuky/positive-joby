<?php

namespace App\Orchid\Screens\Job;


use App\Models\Job;
use App\Models\Job_employment_type;
use App\Models\Experience;
use App\Models\Employment_type;
use App\Models\Homeoffice;
use App\Models\Salary_type;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Quill;

class JobCreateScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
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
        return "Pridanie";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make('Potvrdiť')
                ->icon('plus')
                ->method('createRow'),
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
            Layout::rows([
                Input::make('job.position_name')
                    ->title('Názov Jobu')
                    ->required(),
                Input::make('job.slug')
                    ->title('Slug')
                    ->required(),
                Relation::make('job_employment_type.id_employment_type.')
                    ->title('Druh pracovného pomeru')
                    ->fromModel(Employment_type::class, 'name')
                    ->multiple()
                    ->required(),
                Select::make('job.id_experience')
                    ->title('Skúsenosti')
                    ->fromModel(Experience::class, 'name')
                    ->required(),
                Select::make('job.id_homeoffice')
                    ->title('Práca z domu')
                    ->fromModel(Homeoffice::class, 'name'),
                Select::make('job.id_salary_type')
                    ->title('Typ platu')
                    ->fromModel(Salary_type::class, 'name')
                    ->required(),
                Input::make('job.salary_from')
                    ->title('Plat od')
                    ->type('number')
                    ->required(),
                Input::make('job.salary_to')
                    ->title('Plat do')
                    ->type('number'),
                Quill::make('job.description')
                    ->title('Popis')
                    ->required(),
                Quill::make('job.salary_conditions')
                    ->title('Mzdové podmienky')
                    ->required(),
                Quill::make('job.expectation')
                    ->title('Očakávania')
                    ->required(),
                Quill::make('job.benefits')
                    ->title('Benefity')
                    ->required(),
            ])
        ];
    }

    public function createRow(Job $job, Job_employment_type $jobEmploymentType, Request $request)
    {
        $job->fill($request->get('job'))->save();

        $jobEmploymentType->fill($request->get('job_employment_type'));
        foreach($jobEmploymentType->id_employment_type as $employmentTypeId)
        {
            $tmpJobEmploymentType = new Job_employment_type;
            $tmpJobEmploymentType->id_job = $job->id;
            $tmpJobEmploymentType->id_employment_type = $employmentTypeId;
            $tmpJobEmploymentType->save();
        }

        Alert::info('Úspešne ste pridali nový záznam.');
        return redirect()->route('platform.job.list');
    }
}
