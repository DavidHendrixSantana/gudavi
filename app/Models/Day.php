<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    protected $table = 'days';
    protected $guarded = [];

    public function teacher(){
        return $this->belongsToMany(Teacher::class);
    }
}