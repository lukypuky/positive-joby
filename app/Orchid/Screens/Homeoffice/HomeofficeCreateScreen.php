<?php

namespace App\Orchid\Screens\Homeoffice;

use App\Models\Homeoffice;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class HomeofficeCreateScreen extends Screen
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
        return 'Práca z domu';
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
    public function commandBar(): iterable
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
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('homeoffice.name')
                    ->title('Hodnota'),
            ])
        ];
    }

    public function createRow(Homeoffice $homeoffice, Request $request)
    {
        $homeoffice->fill($request->get('homeoffice'))->save();

        Alert::info('Úspešne ste pridali nový záznam.');

        return redirect()->route('platform.homeoffice.list');
    }
}
