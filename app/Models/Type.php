<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Chambre;

class Type extends Model
{
    use HasFactory;

    public function chambres()
    {
        return $this->hasMany(Chambre::class);
    }
}
