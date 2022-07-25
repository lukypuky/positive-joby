<?php

namespace App\Orchid\Screens\Job;

use App\Models\Job;
use App\Models\Experience;
use App\Models\Employment_type;
use App\Models\Job_employment_type;
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
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Quill;

class JobEditScreen extends Screen
{
    /**
     * @var Job
     */

    public $job;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Job $job): array
    {
        return [
            'job' => $job
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
        return "Editovanie";
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
                ->icon('pencil')
                ->method('updateRow'),
        
            ModalToggle::make('Odstrániť')
                ->icon('trash')
                ->modal('removeRow')
                ->method('remove'),
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
                Relation::make('job_employment_type.id_employment_type')
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
                    ->fromModel(Homeoffice::class, 'name')
                    ->required(),
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
                TextArea::make('job.description')
                    ->title('Popis')
                    ->rows(5)
                    ->required(),
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
            ]),

            Layout::modal('removeRow',Layout::rows([
                ]))->title('Naozaj si prajete odstrániť tento záznam?')->applyButton('Áno')->closeButton('Nie')
        ];
    }

    public function updateRow(Job $job, Request $request)
    {
        $job->fill($request->get('job'))->save();
        $newJobEmploymentTypes = new Job_employment_type;
        $newJobEmploymentTypes->fill($request->get('job_employment_type'));

        Job_employment_type::where('id_job', $job->id)->delete();

        foreach($newJobEmploymentTypes->id_employment_type as $newJobEmploymentType)
        {
            $tmpNewJobEmploymentType = new Job_employment_type;
            $tmpNewJobEmploymentType->id_job = $job->id;
            $tmpNewJobEmploymentType->id_employment_type = $newJobEmploymentType;
            $tmpNewJobEmploymentType->save();
        }

        Alert::info('Úspešne ste upravili záznam.');
        return redirect()->route('platform.job.list');
    }

    public function remove(Job $job)
    {
        $jobEmploymentType = Job_employment_type::where('id_job', $job->id)->get();

        $jobEmploymentType = $jobEmploymentType->toJson();
        $newJobEmploymentType = json_decode($jobEmploymentType);

        foreach($newJobEmploymentType as $employmentType)
        {
            Job_employment_type::where('id', $employmentType->id)->delete();
        }

        $job->delete();

        Alert::info('Záznam bol úspešne odstránený.');

        return redirect()->route('platform.job.list');
    }
}
