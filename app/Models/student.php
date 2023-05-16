<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class student extends Model
{
    use HasTranslations;
    use HasFactory;
    public $translatable = ['name'];
    protected $guarded=[];
    public function gender(){
        return $this->belongsTo(Gender::class,'gender_id');
    }
    public function section(){
        return $this->belongsTo(section::class,'section_id');
    }
    public function grade(){
        return $this->belongsTo(Grade::class,'Grade_id');
    }
    public function classroom(){
        return $this->belongsTo(Classroom::class,'classroom_id');
    }
    public function images(){
        return $this->morphMany(image::class,'imageable');
    }
    public function Nationality(){
        return $this->belongsTo(Nationalitie::class,'nationalitie_id');
    }
    public function myparent(){
        return $this->belongsTo(My_Parent::class,'parent_id');
    }
}
