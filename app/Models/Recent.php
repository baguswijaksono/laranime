<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recent extends Model
{
    protected $fillable = ['page', 'json'];
    public $timestamps = false;
    use HasFactory;
}
