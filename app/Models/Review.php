<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    protected $fillable = [
        'description',
        'user_id',
        'star_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function star(){
        return $this->belongsTo(Star::class);
    }

}
