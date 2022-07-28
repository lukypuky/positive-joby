<?php

namespace App\Orchid\Screens\Reference;

use App\Models\Reference;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\Quill;

class ReferenceCreateScreen extends Screen
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
        return 'Referencie';
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
                Input::make('reference.name')
                    ->title('Meno')
                    ->required(),
                Input::make('reference.company')
                    ->title('Spoločnosť')
                    ->required(),
                Quill::make('reference.description')
                    ->title('Popis')
                    ->rows(20)
                    ->required(),
                Picture::make('reference.img_path')
                    ->title('Obrázok')
                    ->storage('local')
                    ->required(),
            ])
        ];
    }

    public function createRow(Reference $reference, Request $request)
    {
        $reference->fill($request->get('reference'))->save();

        Alert::info('Úspešne ste pridali nový záznam.');

        return redirect()->route('platform.reference.list');
    }
}
