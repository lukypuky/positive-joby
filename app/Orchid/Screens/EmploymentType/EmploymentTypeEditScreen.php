<?php

namespace App\Orchid\Screens\EmploymentType;

use App\Models\Employment_type;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;

class EmploymentTypeEditScreen extends Screen
{
    /**
     * @var Employment_type
     */

    public $employmentType;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Employment_type $employmentType): array
    {
        return [
            '$employment_type' => $employmentType
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Druh pracovneho pomeru';
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
                Input::make('employment_type.name')
                    ->title('Hodnota')
                    ->required(),
            ]),

            Layout::modal('removeRow',Layout::rows([
            ]))->title('Naozaj si prajete odstrániť tento záznam?')->applyButton('Áno')->closeButton('Nie')
        ];
    }

    public function updateRow(Employment_type $employmentType, Request $request)
    {
        $employmentType->fill($request->get('employment_type'))->save();

        Alert::info('Úspešne ste upravili záznam.');

        return redirect()->route('platform.employmentType.list');
    }

    public function remove(Employment_type $employmentType)
    {
        $employmentType->delete();

        Alert::info('Záznam bol úspešne odstránený.');

        return redirect()->route('platform.employmentType.list');
    }
}
