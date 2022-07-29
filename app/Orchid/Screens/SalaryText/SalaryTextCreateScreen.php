<?php

namespace App\Orchid\Screens\SalaryText;

use App\Models\Salary_text;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class SalaryTextCreateScreen extends Screen
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
        return 'Doplňujúci text platu';
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
                Input::make('salary_text.name')
                    ->title('Hodnota')
                    ->required(),
            ])
        ];
    }

    public function createRow(Salary_text $salaryText, Request $request)
    {
        $salaryText->fill($request->get('salary_text'))->save();

        Alert::info('Úspešne ste pridali nový záznam.');

        return redirect()->route('platform.salaryText.list');
    }
}
