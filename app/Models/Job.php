<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Job extends Model
{
    use HasFactory;
    use AsSource, Filterable;

    protected $fillable = [
        'position_name',
        'slug',
        'id_employment_type',
        'id_experience',
        'id_homeoffice',
        'id_salary_type',
        'salary_from',
        'salary_to',
        'description',
        'expectation',
        'benefits'
    ];

    public function getRouteKeyName()
    {
      return 'slug';
    }
}

