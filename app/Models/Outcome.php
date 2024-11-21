<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outcome extends Model
{
    use HasFactory;

    protected $dates = ['outcome_date'];

    protected $casts = [
        'outcome_date' => 'datetime',
    ];

    protected $fillable = [
        'outcome_description',
        'outcome_amount',
        'outcome_date',
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
