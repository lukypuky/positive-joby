<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\SkusenostiEditLayout;
use App\Models\Skusenost;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;


class SkusenostiEditScreen extends Screen
{
    /**
     * @var Skusenost
     */

     public $skusenost;
    /**
     * Query data.
     *
     * @return array
     */
    
    public function query(Skusenost $skusenost): array
    {
        return [
            'skusenost' => $skusenost
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Skúsenosti';
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
                Input::make('skusenost.nazov')
                    ->title('Názov')
                    ->placeholder('Názov skúsenosti')
                    ->help('Zadajte názov pre danú skúsenosť')
            ]),

            Layout::modal('removeRow',Layout::rows([
            ]))->title('Naozaj si prajete odstrániť tento záznam?')->applyButton('Áno')->closeButton('Nie')
        ];
    }

    public function updateRow(Skusenost $skusenost,Request $request)
    {
        $skusenost->fill($request->get('skusenost'))->save();

        Alert::info('Úspešne ste upravili záznam.');

        return redirect()->route('platform.skusenosti.list');
    }

    public function remove(Skusenost $skusenost)
    {
        $skusenost->delete();

        Alert::info('Záznam bol úspešne odstránený.');

        return redirect()->route('platform.skusenosti.list');
    }
}
