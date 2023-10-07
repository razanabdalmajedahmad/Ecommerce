<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categure extends Model
{
    use HasFactory;
    protected $fillable=[
        'name_en',
        'name_ar',
        'image',
    ];
    public function Prodacts(){
        return $this->hasMany(Prodact::class,'categure');
    }
}
