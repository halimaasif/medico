<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticHistory extends Model
{
    // Database table ka naam agar default se alag hai to yahan define karein
    protected $table = 'diagnostic_histories';

    // Mass assignment ke liye allow karein
    protected $fillable = [
        'user_id', 
        'keywords', 
        'condition_name', 
        'severity_levels'
    ];
}