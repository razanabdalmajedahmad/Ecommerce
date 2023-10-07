<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdactSize extends Model
{
    use HasFactory;
    protected $fillable=[
        'size','prodact_id'
    ];
}
