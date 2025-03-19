<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Scope extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable=["scopes_description","project_id"];
        public function project(){
        return $this->belongsTo(Project::class);
    }
}
