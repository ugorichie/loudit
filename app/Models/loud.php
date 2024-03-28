<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loud extends Model
{
    use HasFactory;


    protected $fillable = [
        'loud',
        //'likes',
        // 'password',
    ];

    public function comments(){
        return $this->hasMany(comment::class, 'loud_id', 'id');
    }

}
