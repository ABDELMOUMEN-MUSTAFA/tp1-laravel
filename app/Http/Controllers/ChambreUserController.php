<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreUserController extends Controller
{
    public function detachUser(Chambre $chambre, User $user)
    {
        $user->chambres()->detach($chambre->id);
        return redirect()->route("chambres.show", $chambre->id)->with("message", "L'utilisateur detaché avec succé.");
    }
}
