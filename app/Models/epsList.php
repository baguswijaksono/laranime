<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class epsList extends Model
{
    protected $fillable = ['animeId', 'episodeId','episodeNum'];
    public $timestamps = false;
    use HasFactory;
}
