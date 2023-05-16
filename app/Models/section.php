<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class section extends Model
{
    use HasTranslations;
    public $translatable = ['name_section'];
    protected $table = 'sections';
    protected $fillable=['name_section','grade_id','class_id'];
    public $timestamps = true;

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'class_id');
    }
    public function teachers()
    {
        return $this->belongsToMany(teacher::class,'teacher_section');
    }
}
