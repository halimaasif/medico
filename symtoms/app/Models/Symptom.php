<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    use HasFactory;

    protected $table = 'symptoms';

    protected $fillable = [
        'user_id',
        'keywords',
        'condition_name',
        'severity_levels',
        'duration',
        'emergency_situation',
        'medications'
    ];

    protected $casts = [
        'medications' => 'array',
    ];
}