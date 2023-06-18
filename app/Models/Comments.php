<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = ['id','username','role','episodeId','comment','at'];
    public $timestamps = false;
    use HasFactory;
}
