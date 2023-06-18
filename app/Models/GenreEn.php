<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreEn extends Model
{
    protected $fillable = ['page','genre', 'animeId','animeTitle','animeImg','releasedDate'];
    public $timestamps = false;
    use HasFactory;
}
