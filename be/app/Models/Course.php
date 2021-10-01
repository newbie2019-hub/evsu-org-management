<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    public $fillable = ['college_id', 'course', 'abbreviation'];

    public function college(){
        return $this->belongsTo(College::class, 'college_id', 'id');
    }
}
