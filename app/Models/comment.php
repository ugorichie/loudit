<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comments',
        'loud_id',
        'user_id'
    ];

    // public function comments(){
    //     return $this->hasMany(Comment::class, 'loud_id', 'id');
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
