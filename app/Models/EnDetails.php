<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnDetails extends Model
{
    protected $fillable = ['anime_id', 'animeTitle','type','releasedDate','status','genres','otherNames','synopsis','totalEpisodes','episodesList','animeImg'];
    public $timestamps = false;
    use HasFactory;
}
