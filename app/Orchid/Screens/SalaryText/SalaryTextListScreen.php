<?php

namespace App\Orchid\Screens\SalaryText;

use App\Models\Salary_text;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class SalaryTextListScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        $salaryText = Salary_text::paginate(10);

        return [
            'salary_texts' => $salaryText
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Doplňujúci text platu';
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
            Link::make('Pridať nový doplňujúci text platu')
                ->icon('plus')
                ->route('platform.salaryText.create')
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
            Layout::table('salary_texts',[
                TD::make('Názov')
                    ->filter(TD::FILTER_TEXT)
                    ->sort()
                    ->render(function ($salaryText) {
                        return $salaryText->name;
                    }),
                TD::make('Akcie')
                    ->render(function (Salary_text $salaryText) {
                        return Link::make('')
                            ->icon('pencil')
                            ->route('platform.salaryText.edit', $salaryText);
                    }), 
            ])
        ];
    }
}
