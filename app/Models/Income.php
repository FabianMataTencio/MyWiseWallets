<?php

namespace App\Models;

use App\Models\Cash_Folow;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;
    
    protected $dates = ['income_date'];

    protected $casts = [
        'income_date' => 'datetime',
    ];

    protected $fillable = [
        'income_description',
        'income_amunt',
        'income_date',
        'image',
        'user_id',
        'categorie_id',
        'cash_folow_id',
        'active',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }

    public function cash_folow(){
        return $this->belongsTo(Cash_Folow::class);
    }
}
