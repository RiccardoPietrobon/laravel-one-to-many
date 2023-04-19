<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    //fillable
    protected $fillable = ['color', 'label']; //le colonne nel fillable


    //relations
    public function projects()
    {
        return $this->hasMany(Project::class); //un tipo sarà in più post
    }
}