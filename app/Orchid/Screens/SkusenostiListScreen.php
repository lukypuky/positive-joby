<?php

namespace App\Orchid\Screens;

use App\Orchid\Layouts\SkusenostiListLayout;
use App\Models\Skusenost;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\TD;


class SkusenostiListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $skusenosti = Skusenost::paginate(10);

        return [
            'skusenosti' => $skusenosti
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
            Link::make('Pridať novú skúsenosť')
                ->icon('plus')
                ->route('platform.skusenosti.create')
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
            Layout::table('skusenosti',[
                TD::make('Názov')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($skusenost) {
                        return $skusenost->nazov;
                    }),
                TD::make('Akcie')
                    ->render(function (Skusenost $skusenost) {
                        return Link::make('')
                            ->icon('pencil')
                            ->route('platform.skusenosti.edit', $skusenost);
                    }), 
            ])
        ];
    }
}
