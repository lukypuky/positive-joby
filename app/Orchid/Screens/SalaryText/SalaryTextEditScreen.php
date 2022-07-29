<?php

namespace App\Orchid\Screens\SalaryText;

use App\Models\Salary_text;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;

class SalaryTextEditScreen extends Screen
{
    /**
     * @var Salary_text
     */

    public $salaryText;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Salary_text $salaryText): array
    {
        return [
            'salary_text' => $salaryText
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Doplňujúci text platu';
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
                Input::make('salary_text.name')
                    ->title('Hodnota')
                    ->required(),
            ]),

            Layout::modal('removeRow',Layout::rows([
            ]))->title('Naozaj si prajete odstrániť tento záznam?')->applyButton('Áno')->closeButton('Nie')
        ];
    }

    public function updateRow(Salary_text $salaryText, Request $request)
    {
        $salaryText->fill($request->get('salary_text'))->save();

        Alert::info('Úspešne ste upravili záznam.');

        return redirect()->route('platform.salaryText.list');
    }

    public function remove(Salary_text $salaryText)
    {
        $salaryText->delete();

        Alert::info('Záznam bol úspešne odstránený.');

        return redirect()->route('platform.salaryText.list');
    }
}
