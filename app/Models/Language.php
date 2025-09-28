<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'lang',
        'slug',
        'country_code',
        'default',
        'status'
    ];

    protected $casts = [
        'default' => 'boolean',
        'status' => 'boolean',
    ];
}