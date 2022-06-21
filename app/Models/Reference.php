<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Reference extends Model
{
    use HasFactory;
    use AsSource, Filterable;

    protected $fillable = [
        'name',
        'company',
        'img_path',
        'description'
    ];
}
