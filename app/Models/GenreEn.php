<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreEn extends Model
{
    protected $fillable = ['page','genre', 'json'];
    public $timestamps = false;
    use HasFactory;
    use HasFactory;
}
