<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Popular extends Model
{
    protected $fillable = ['page', 'animeId','animeTitle','animeImg','releasedDate'];
    public $timestamps = false;
    use HasFactory;
}
