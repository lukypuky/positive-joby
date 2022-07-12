<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'contact_type',
        'id_job',
        'name_surname',
        'phone',
        'email',
        'message'
    ];
}
