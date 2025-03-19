<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{
    use HasFactory;

    use SoftDeletes;

    static $rules = [
        'feature_name' => 'required',
        'laboratory_id' => 'required'
    ];

    protected $fillable = ['feature_name','laboratory_id'];
}
