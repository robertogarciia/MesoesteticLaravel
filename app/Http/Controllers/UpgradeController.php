<?php

namespace App\Http\Controllers;

use App\Models\Upgrade;
use Illuminate\Http\Request;

class UpgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('crearUpgrade');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $upgrade = Upgrade::create($request->all());
        return redirect('principal');
    }

    /**
     * Display the specified resource.
     */
    public function show(Upgrade $upgrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upgrade $upgrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upgrade $upgrade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upgrade $upgrade)
    {
        //
    }
}
