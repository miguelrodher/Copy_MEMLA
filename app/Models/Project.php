<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable=["title","describe_problem","describe_justification","goal","start_date","final_date","user_id"];
    public function activities(){

        return $this->belongsToMany(Activity::class);
    }

    public function members(){
        return $this->belongsTo(Member::class);
    }

    public function scopes(){
        return $this->hasMany(Scope::class);

    }

    public function limitations(){
        return $this->hasMany(Limitation::class);
    }

    public function hypotheses(){
        return $this->hasMany(Hypotheses::class);

    }

    public function assigns_specifics(){
        return $this->belongsToMany(SpecificGoal::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }


}
