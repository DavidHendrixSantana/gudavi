<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher_pay extends Model
{

    use HasFactory;
    protected $table = 'teachers_pay';
    protected $guarded = [];
    protected $fillable = ['total_classes', 'porcentuales'];

}
