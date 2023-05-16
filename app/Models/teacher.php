<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class teacher extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded=[];
    public $timestamps = true;

    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }
    public function specilize()
    {
        return $this->belongsTo(specilization::class, 'specilize_id');
    }

    public function sections()
    {
        return $this->belongsToMany(section::class,'teacher_section');
    }
}
