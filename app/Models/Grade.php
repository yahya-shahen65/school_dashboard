<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
class Grade extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    protected $fillable=['name','notes'];
    protected $table = 'grades';
    public $timestamps = true;

    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }
    public function sections()
    {
        return $this->hasMany(section::class);
    }
}
