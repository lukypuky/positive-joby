<?php

namespace App\Orchid\Screens\EmploymentType;

use App\Models\Employment_type;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class EmploymentTypeListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $employmentType = Employment_type::paginate(10);

        return [
            'employment_types' => $employmentType
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Druh pracovného pomeru';
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
            Link::make('Pridať nový druh pracovného pomeru')
                ->icon('plus')
                ->route('platform.employmentType.create')
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
            Layout::table('employment_types',[
                TD::make('Názov')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($employmentType) {
                        return $employmentType->name;
                    }),
                TD::make('Akcie')
                    ->render(function (Employment_type $employmentType) {
                        return Link::make('')
                            ->icon('pencil')
                            ->route('platform.employmentType.edit', $employmentType);
                    }), 
            ])
        ];
    }
}
