<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = ['nombre','descripcion','municipio',];

    //relationships
    public function autos()
    {
        return $this->belongsToMany(Auto::class, 'auto_location');
    }
}
