<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinalResult extends Model
{
    protected $fillable = ['section_id', 'processor'];

    public function section()
    {
        return $this->belongsTo(\App\Section::class);
    }

    public function final_report()
    {
        return $this->hasMany(\App\FinalReport::class);
    }
}
