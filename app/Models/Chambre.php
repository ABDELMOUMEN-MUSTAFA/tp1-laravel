<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;
use App\Models\User;

class Chambre extends Model
{
    use HasFactory;

    protected $fillable = [
        "type_id",
        "description",
        "superficie",
        "etage",
        "prix",
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(["date_depart", "date_arrivee"])->withTimestamps();
    }
}
