<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EconomicGoal extends Model
{
    use HasFactory;

    protected $dates = ['start_date', 'deadline'];

    protected $casts = [
        'start_date' => 'datetime',
        'deadline' => 'datetime',
    ];

    protected $fillable = [
        'goal_name',
        'goal_description',
        'start_date',
        'deadline',
        'goal_amount',
        'funds_deposited',
        'user_id',
        'categorie_id',
        'cash_folow_id',
        'state_id',
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

    public function state(){
        return $this->belongsTo(State::class);
    }
}
