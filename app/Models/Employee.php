<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
        'birth_date',
        'email',
        'status',
        'extension',
        'name',
        'lastname',
        'jobtitle',
        'sector'
    ];
}
