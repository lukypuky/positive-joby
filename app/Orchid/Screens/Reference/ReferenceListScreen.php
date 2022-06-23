<?php

namespace App\Orchid\Screens\Reference;

use App\Models\Reference;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class ReferenceListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $references = Reference::paginate(10);

        return [
            'references' => $references
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
        return "Prehľad";
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Pridať novú referenciu')
                ->icon('plus')
                ->route('platform.reference.create')
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
            Layout::table('references',[
                TD::make('Meno')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($reference) {
                        return $reference->name;
                    }),
                TD::make('Spoločnosť')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($reference) {
                        return $reference->company;
                    }),
                TD::make('Image path')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($reference) {
                        return $reference->img_path;
                    }),
                TD::make('Popis')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->width('500px')
                    ->render(function ($reference) {
                        return $reference->description;
                    }),
                TD::make('Akcie')
                    ->render(function (Reference $reference) {
                        return Link::make('')
                            ->icon('pencil')
                            ->route('platform.reference.edit', $reference);
                    }), 
            ])
        ];
    }
}
