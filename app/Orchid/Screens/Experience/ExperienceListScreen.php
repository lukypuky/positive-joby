<?php

namespace App\Orchid\Screens\Experience;

use App\Models\Experience;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class ExperienceListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $experiences = Experience::paginate(10);
        
        return [
            'experiences' => $experiences
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
                ->route('platform.experience.create')
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
            Layout::table('experiences',[
                TD::make('Názov')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($experience) {
                        return $experience->name;
                    }),
                TD::make('Akcie')
                    ->render(function (Experience $experience) {
                        return Link::make('')
                            ->icon('pencil')
                            ->route('platform.experience.edit', $experience);
                    }), 
            ])
        ];
    }
}
