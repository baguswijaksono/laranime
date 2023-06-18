<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userActivity extends Model
{
    protected $fillable = ['userName', 'activityType','animeId','episodeId','content','at'];
    public $timestamps = false;
    use HasFactory;
}
