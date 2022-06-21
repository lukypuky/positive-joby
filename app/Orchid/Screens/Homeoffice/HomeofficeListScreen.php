<?php

namespace App\Orchid\Screens\Homeoffice;

use App\Models\Homeoffice;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class HomeofficeListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $homeoffices = Homeoffice::paginate(10);
        return [
            'homeoffices' => $homeoffices
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
            Link::make('Pridať novú hodnotu pre prácu z domu')
                ->icon('plus')
                ->route('platform.homeoffice.create')
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
            Layout::table('homeoffices',[
                TD::make('Názov')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($homeoffice) {
                        return $homeoffice  ->name;
                    }),
                TD::make('Akcie')
                    ->render(function (Homeoffice $homeoffice) {
                        return Link::make('')
                            ->icon('pencil')
                            ->route('platform.homeoffice.edit', $homeoffice);
                    }), 
            ])
        ];
    }
}
