<?php

namespace App\Http\Controllers;

use App\Models\Chambre;
use App\Models\Type;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chambres = Chambre::all();
        return view("Chambre.index", compact("chambres"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $etages = ["RDC", 1, 2, 3];
        return view("Chambre.create", compact("types", "etages"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "type_id" => ["required", "exists:types,id"],
            "etage" => ["required", "in:1,2,3,RDC"],
            "description" => ["required", "max:200"],
            "superficie" => ["required", "integer", "between:15,60"],
            "prix" => ["required", "numeric", "gt:10"]
        ]);

        Chambre::create($validatedData);
        return redirect()->route("chambres.index")->with("message", "la chambre est ajoutée avec succée.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chambre $chambre)
    {
        return view("Chambre.show", compact("chambre"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Chambre $chambre)
    {
        $types = Type::all();
        $etages = ["RDC", 1, 2, 3];
        return view("Chambre.edit", compact("chambre", "types", "etages"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chambre $chambre)
    {
        $validatedData = $request->validate([
            "type_id" => ["required", "exists:types,id"],
            "etage" => ["required", "in:1,2,3,RDC"],
            "description" => ["required", "max:200"],
            "superficie" => ["required", "integer", "between:15,60"],
            "prix" => ["required", "numeric", "gt:10"]
        ]);

        Chambre::where(["id" => $chambre->id])->update($validatedData);
        return redirect()->route("chambres.index")->with("message", "la chambre est modifiée avec succée.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chambre $chambre)
    {
        $chambre->delete();
        return redirect()->route("chambres.index")->with("message", "la chambre est supprimée avec succée.");
    }
}
