<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lords extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'lords';
    protected $dates = ['deleted_at'];
    protected $casts = [
        'seasons_appeared' => 'array',
        'titles' => 'array',
        'aliases' => 'array'
    ];
    protected $fillable = [
        'name',
        'house',
        'seasons_appeared',
        'gender',
        'titles',
        'aliases',
        'interpretedBy'
    ];
}
