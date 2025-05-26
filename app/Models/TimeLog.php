<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimeLog extends Model
{
    //
    protected $fillable = [
        'project_id',
        'start_time',
        'end_time',
        'description',
    ];
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
