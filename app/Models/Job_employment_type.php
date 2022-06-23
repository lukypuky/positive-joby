<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Job_employment_type extends Model
{
    use HasFactory;
    use AsSource, Filterable;

    protected $fillable = [
        'id_job',
        'id_employment_type'
    ];
}
