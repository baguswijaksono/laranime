<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class genreList extends Model
{
    protected $fillable = ['name','slug'];
    public $timestamps = false;
    use HasFactory;
}
