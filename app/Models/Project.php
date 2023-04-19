<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'text', 'published', 'type_id']; //le colonne nel fillable

    //relations

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class); //un progetto può avere un tipo
    }

    public function getAbstract($max = 50)
    {
        return substr($this->text, 0, $max) . "...";
    }

    public static function generateUniqueSlug($title)
    {
        $possible_slug = Str::of($title)->slug('-');
        $projects = Project::where('slug', $possible_slug)->get();
        $original_slug = $possible_slug;
        $i = 2;
        while (count($projects)) {
            $possible_slug = $original_slug . "-" . $i;
            $projects = Project::where('slug', $possible_slug)->get();
            $i++;
        }
        return $possible_slug;
    }

    protected function getUpdatedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value)); //setta questo attributo
    }

    protected function getCreatedAtAttribute($value)
    {
        return date('d/m/Y H:i', strtotime($value)); //setta questo attributo
    }

    public function getImageUri()
    {
        return $this->image ? asset('storage/' . $this->image) : "https://img.freepik.com/free-vector/luxury-gradient-modern-abstract-background_343694-1911.jpg"; //setta questo attributo così posso avere sempre un placeholder
    }
}