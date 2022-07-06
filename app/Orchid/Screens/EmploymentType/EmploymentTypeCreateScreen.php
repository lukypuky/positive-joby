<?php

namespace App\Orchid\Screens\EmploymentType;

use App\Models\Employment_type;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class EmploymentTypeCreateScreen extends Screen
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
        return 'Druh pracovneho pomeru';
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
                Input::make('employment_type.name')
                    ->title('Hodnota'),
            ])
        ];
    }

    public function createRow(Employment_type $employmentType, Request $request)
    {
        $employmentType->fill($request->get('employment_type'))->save();

        Alert::info('Úspešne ste pridali nový záznam.');

        return redirect()->route('platform.employmentType.list');
    }
}