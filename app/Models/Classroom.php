<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Classroom extends Model
{
    use HasTranslations;
    public $translatable = ['name_class'];
    protected $table = 'classrooms';
    protected $fillable=['name_class','grade_id'];
    public $timestamps = true;

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function sections()
    {
        return $this->hasMany(section::class);
    }
}
