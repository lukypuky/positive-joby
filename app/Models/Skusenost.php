<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Skusenost extends Model
{
    use AsSource, Filterable;

    protected $fillable = [
        'nazov'
    ];
}
