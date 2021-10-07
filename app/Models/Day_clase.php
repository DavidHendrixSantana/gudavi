<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day_clase extends Model
{
    use HasFactory;
    protected $table = 'days_classes';
    protected $fillable = ['day_id', 'class_id', 'person_id'];
}
