<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //LAB 6 PART TWO
    protected $fillable = ['car_id','car_review','car_rating'];
    protected $guarded=['car_id'];
    public function creator()
    {
        return $this->belongsTo(Car::class, 'car_id', 'id');
    }



}
