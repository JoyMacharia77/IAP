<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['make','model','produced_on'];

    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }

}
