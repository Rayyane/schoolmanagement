<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinalResult extends Model
{
    protected $fillable = ['section_id', 'processor'];

    public function section()
    {
        return $this->belongsTo(\App\Models\Section::class);
    }

    public function final_report()
    {
        return $this->hasMany(\App\Models\FinalReport::class);
    }
}
