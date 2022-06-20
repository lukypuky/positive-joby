<?php

namespace App\Orchid\Layouts;

use App\Models\Skusenost;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class SkusenostiListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    public $target = 'skusenosti';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('nazov', 'Nazov')
                ->render(function (Skusenost $skusenost) {
                    return Link::make($skusenost->nazov)
                        ->route('platform.skusenosti.edit', $skusenost);
                }),
        ];
    }
}
