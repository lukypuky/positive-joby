<?php

namespace App\Orchid\Screens\SalaryType;

use App\Models\Salary_type;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;

class SalaryTypeEditScreen extends Screen
{
    /**
     * @var Salary_type
     */

    public $salaryType;
    /**
     * Query data.
     *
     * @return array
     */
    
    public function query(Salary_type $salaryType): array
    {
        return [
            'salary_type' => $salaryType
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Typ platu';
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
                Input::make('salary_type.name')
                    ->title('Hodnota')
                    // ->placeholder('Názov skúsenosti')
                    // ->help('Zadajte názov pre danú skúsenosť')
            ]),

            Layout::modal('removeRow',Layout::rows([
            ]))->title('Naozaj si prajete odstrániť tento záznam?')->applyButton('Áno')->closeButton('Nie')
        ];
    }

    public function updateRow(Salary_type $salaryType, Request $request)
    {
        $salaryType->fill($request->get('salary_type'))->save();

        Alert::info('Úspešne ste upravili záznam.');

        return redirect()->route('platform.salaryType.list');
    }

    public function remove(Salary_type $salaryType)
    {
        $salaryType->delete();

        Alert::info('Záznam bol úspešne odstránený.');

        return redirect()->route('platform.salaryType.list');
    }
}
