<?php

namespace App\Orchid\Screens\Reference;

use App\Models\Reference;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\TextArea;

class ReferenceEditScreen extends Screen
{
    /**
     * @var Reference
     */

    public $reference;
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Reference $reference): array
    {
        return [
            'reference' => $reference
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Referencie';
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
                Input::make('reference.name')
                    ->title('Hodnota'),
                Input::make('reference.company')
                    ->title('Spoločnosť'),
                TextArea::make('reference.description')
                    ->title('Popis')
                    ->rows(5),
            ]),

            Layout::modal('removeRow',Layout::rows([
            ]))->title('Naozaj si prajete odstrániť tento záznam?')->applyButton('Áno')->closeButton('Nie')
        ];
    }

    public function updateRow(Reference $reference, Request $request)
    {
        $reference->fill($request->get('reference'))->save();

        Alert::info('Úspešne ste upravili záznam.');

        return redirect()->route('platform.reference.list');
    }

    public function remove(Reference $reference)
    {
        $reference->delete();

        Alert::info('Záznam bol úspešne odstránený.');

        return redirect()->route('platform.reference.list');
    }
}
