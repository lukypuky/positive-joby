<?php

namespace App\Orchid\Screens\Experience;

use App\Models\Experience;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;

class ExperienceEditScreen extends Screen
{
    /**
     * @var Experience
     */

    public $experience;
    /**
     * Query data.
     *
     * @return array
     */
    
    public function query(Experience $experience): array
    {
        return [
            'experience' => $experience
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
                Input::make('experience.name')
                    ->title('Hodnota')
            ]),

            Layout::modal('removeRow',Layout::rows([
            ]))->title('Naozaj si prajete odstrániť tento záznam?')->applyButton('Áno')->closeButton('Nie')
        ];
    }

    public function updateRow(Experience $experience, Request $request)
    {
        $experience->fill($request->get('experience'))->save();

        Alert::info('Úspešne ste upravili záznam.');

        return redirect()->route('platform.experience.list');
    }

    public function remove(Experience $experience)
    {
        $experience->delete();

        Alert::info('Záznam bol úspešne odstránený.');

        return redirect()->route('platform.experience.list');
    }
}
