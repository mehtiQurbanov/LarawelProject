<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Owner::class, 'owner');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchOwnerName = $request->session()->get('searchOwnerName');
        if($searchOwnerName!=null){
            $owners=Owner::select("id", "name", "surname")->
            orWhere(DB::raw("concat(name, ' ', surname)"), 'LIKE', "%".$searchOwnerName."%")->
            with('cars')->get();
        }else{
            $owners=Owner::with('cars')->get();
        }
        return view("owners.index", [
            "owners"=>$owners,
            "searchOwnerName"=>$searchOwnerName
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("owners.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|min:2',
            'surname'=>'required|min:2',
        ], [
            "name"=>__("Name is required and must be at least 2 characters"),
            "surname"=>__("Surname is required and must be at least 2 characters"),
        ]);

        $owner = new Owner();
        $owner->name=$request->name;
        $owner->surname=$request->surname;
        $owner->save();
        return redirect()->route("owners.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Owner $owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Owner $owner)
    {
        return view("owners.edit", [
            "owner"=>$owner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Owner $owner)
    {
        $owner->name=$request->name;
        $owner->surname=$request->surname;
        $owner->save();
        return redirect()->route("owners.index");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Owner $owner)
    {
        $owner->delete();
        return redirect()->route("owners.index");
    }

    public function search(Request $request){
        $request->session()->put('searchOwnerName', $request->name);
        return redirect()->route('owners.index');
    }
}
