<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class loud extends Model
{
    use HasFactory;


    protected $fillable = [
        'loud',
        'user_id',
        // 'password',
    ];

    public function comments(){
        return $this->hasMany(comment::class, 'loud_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
