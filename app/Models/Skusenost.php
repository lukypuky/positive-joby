<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Skusenost extends Model
{
    use AsSource;

    protected $fillable = [
        'nazov'
    ];
}
