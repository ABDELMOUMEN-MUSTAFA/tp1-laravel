<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Chambre;
use Illuminate\Http\Request;

class ChambreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $searchable = ['description', 'etage'];
        $query = Chambre::query()
            ->when($request->filled('search'), function ($query) use ($searchable, $request) {
                foreach ($searchable as $field) {
                    $query->orWhere($field, 'like', '%' . $request->get('search') . '%');
                }
            });

        return  $query->with("type")->paginate(9);
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

        return Chambre::create($validatedData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chambre $chambre)
    {
        return $chambre->load(['type', 'users']);
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

        return Chambre::where(["id" => $chambre->id])->update($validatedData);
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
        return response()->noContent();
    }
}
