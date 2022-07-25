<?php

namespace App\Orchid\Screens\Homeoffice;

use App\Models\Homeoffice;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;

class HomeofficeEditScreen extends Screen
{
    /**
    * @var Homeoffice
    */

    public $homeoffice;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Homeoffice $homeoffice): array
    {
        return [
            'homeoffice' => $homeoffice
        ];
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
                Input::make('homeoffice.name')
                    ->title('Hodnota')
                    ->required(),
            ]),

            Layout::modal('removeRow',Layout::rows([
            ]))->title('Naozaj si prajete odstrániť tento záznam?')->applyButton('Áno')->closeButton('Nie')
        ];
    }

    public function updateRow(Homeoffice $homeoffice, Request $request)
    {
        $homeoffice->fill($request->get('homeoffice'))->save();

        Alert::info('Úspešne ste upravili záznam.');

        return redirect()->route('platform.homeoffice.list');
    }

    public function remove(Homeoffice $homeoffice)
    {
        $homeoffice->delete();

        Alert::info('Záznam bol úspešne odstránený.');

        return redirect()->route('platform.homeoffice.list');
    }
}
