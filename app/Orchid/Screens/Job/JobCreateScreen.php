<?php

namespace App\Orchid\Screens\Job;


use App\Models\Job;
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
                    ->title('Názov Jobu'),
                Input::make('job.slug')
                    ->title('Slug'),
                Select::make('job.id_employment_type')
                    ->title('Druh pracovného pomeru')
                    ->fromModel(Employment_type::class, 'name'),
                Select::make('job.id_experience')
                    ->title('Skúsenosti')
                    ->fromModel(Experience::class, 'name'),
                Select::make('job.id_homeoffice')
                    ->title('Práca z domu')
                    ->fromModel(Homeoffice::class, 'name'),
                Select::make('job.id_salary_type')
                    ->title('Typ platu')
                    ->fromModel(Salary_type::class, 'name'),
                Input::make('job.salary_from')
                    ->title('Plat od')
                    ->type('number'),
                Input::make('job.salary_to')
                    ->title('Plat do')
                    ->type('number'),
                TextArea::make('job.description')
                    ->title('Popis')
                    ->rows(5),
                TextArea::make('job.expectation')
                    ->title('Očakávania')
                    ->rows(5),
                TextArea::make('job.benefits')
                    ->title('Benefity')
                    ->rows(5),
            ])
        ];
    }

    public function createRow(Job $job, Request $request)
    {
        $job->fill($request->get('job'))->save();

        Alert::info('Úspešne ste pridali nový záznam.');

        return redirect()->route('platform.job.list');
    }
}
