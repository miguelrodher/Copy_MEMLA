<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hypotheses extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=["hypotesys_description","project_id"];


    public function project(){
        return $this->belongsTo(Project::class);
    }

}
