<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auto extends Model
{
    use HasFactory;

    protected $fillable =['marca','modelo','tipo',];

    //relationships
    public function locations()
    {
        return $this->belongsToMany(Location::class, 'auto_location');
    }
}
