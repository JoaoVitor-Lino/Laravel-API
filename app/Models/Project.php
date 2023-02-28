<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public $table = 'projects';

    protected $fillable = [
        'name',
        'sex',
        'age',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

}
