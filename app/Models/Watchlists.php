<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watchlists extends Model
{
    protected $fillable = ['email', 'animeId'];
    public $timestamps = false;
    use HasFactory;
}
