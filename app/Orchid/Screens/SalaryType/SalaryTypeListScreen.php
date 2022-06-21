<?php

namespace App\Orchid\Screens\SalaryType;

use App\Models\Salary_type;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class SalaryTypeListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $salaryType = Salary_type::paginate(10);
        
        return [
            'salary_types' => $salaryType
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Typ Platu';
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
            Link::make('Pridať nový typ platu')
                ->icon('plus')
                ->route('platform.salaryType.create')
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
            Layout::table('salary_types',[
                TD::make('Názov')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($salaryType) {
                        return $salaryType->name;
                    }),
                TD::make('Akcie')
                    ->render(function (Salary_type $salaryType) {
                        return Link::make('')
                            ->icon('pencil')
                            ->route('platform.salaryType.edit', $salaryType);
                    }), 
            ])
        ];
    }
}
