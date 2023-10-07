<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable=[
        'phone',
        'email',
        'description_en',
        'description_ar',
        'name_en',
        'name_ar',
        'logo',
        'location',
    ];
}
