<?php

namespace App\Models;

use App\Models\Types_Categorie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria',
        'user_id',
        'types_categories_id',
    ];

    public function types_categories(){
        return $this->belongsTo(Types_Categorie::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
