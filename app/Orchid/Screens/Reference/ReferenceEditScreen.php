<?php

namespace App\Orchid\Screens\Reference;

use App\Models\Reference;
use App\Models\Attachment;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Picture;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\Fields\Quill;

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
                    ->title('Hodnota')
                    ->required(),
                Input::make('reference.company')
                    ->title('Spoločnosť')
                    ->required(),
                Quill::make('reference.description')
                    ->title('Popis')
                    ->rows(5)
                    ->required(),
                Picture::make('reference.img_path')
                    ->title('Obrázok')
                    ->storage('local')
                    ->required(),
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
        $path = $reference->img_path;
        $path = substr($path, 8);

        $referenceName = $reference->img_path;
        $referenceName = substr($referenceName, 20, -4);

        Storage::disk('local')->delete($path);

        $reference->delete();

        Attachment::where('name', $referenceName)->delete();

        Alert::info('Záznam bol úspešne odstránený.');

        return redirect()->route('platform.reference.list');
    }
}
