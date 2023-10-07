<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodact extends Model
{
    use HasFactory;
    protected $fillable=[
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
        'quantity',
        'categure',
        'price',
        'condition',
        'status',
        'image',
        'discount',
        'video'
    ];
    public function Categure(){
        return $this->belongsTo(Categure::class,'categure');
    }
    public function Size(){
        return $this->hasMany(ProdactSize::class,'prodact_id');
    }
    public function images(){
        return $this->hasMany(ProdactImage::class,'prodact_id');
    }
}
