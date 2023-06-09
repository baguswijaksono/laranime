<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnDetails extends Model
{
    protected $fillable = ['anime_id', 'json'];
    public $timestamps = false;
    use HasFactory;
}
