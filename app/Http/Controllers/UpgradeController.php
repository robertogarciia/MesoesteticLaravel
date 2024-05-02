<?php

namespace App\Http\Controllers;

use App\Models\Upgrade;
use Illuminate\Http\Request;

class UpgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        
        $upgrades = Upgrade::all(); // Get all upgrades from the database

        return view('indexUpgrades', ['upgrades' => $upgrades]);

    }
    public function upgradesCount() {
        
        $totalMejoras = Upgrade::count(); 

        $countUpgrades = [
            'Valorandose' => Upgrade::where('state', 'Valorandose')->count(),
            'En_curso' => Upgrade::where('state', 'En curso')->count(),
            'Resuelta' => Upgrade::where('state', 'Resuelta')->count(),
        ];

        $percentages = [
            'Valorandose' => ($totalMejoras > 0) ? ($countUpgrades['Valorandose'] / $totalMejoras) * 100 : 0,
            'En_Curso' => ($totalMejoras > 0) ? ($countUpgrades['En_curso'] / $totalMejoras) * 100 : 0,
            'Resuelta' => ($totalMejoras > 0) ? ($countUpgrades['Resuelta'] / $totalMejoras) * 100 : 0,
        ];

        return view('principalPage', compact('countUpgrades', 'percentages'));

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
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'zone' => 'required|string', 
            'type' => 'required|string',
            'worry' => 'required|string',
            'benefit' => 'required|string',
        ]);
        
        $upgrade = new Upgrade();
        $upgrade->title = $request->title;
        $upgrade->zone = $request->zone;
        $upgrade->type = $request->type;
        $upgrade->worry = $request->worry;
        $upgrade->benefit = $request->benefit;
        $upgrade->state = 'Valorandose';
        $upgrade->likes = 0;    
        $upgrade->user_id = auth()->id();
        
        $upgrade->save();

        return redirect()->route('upgrades.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Upgrade $upgrade)
    {
        return view('showUpgrades',['Upgrade'=>$upgrade]);

    }

    public function showChart()
{
    $stateChangeCounts = [
        'Valorandose' => UpgradeStateChange::where('current_state', 'Valorandose')->count(),
        'En_curso' => UpgradeStateChange::where('current_state', 'En curso')->count(),
        'Resuelta' => UpgradeStateChange::where('current_state', 'Resuelta')->count(),
    ];

    return view('principalPage', compact('stateChangeCounts'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upgrade $upgrade)
    {
        

        return view('editupgrade',['upgrade'=>$upgrade]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upgrade $upgrade)
{
    $previous_state = $upgrade->state; // Estado anterior
    $upgrade->update($request->all());

    // Si el estado ha cambiado, guardar en el historial
    if ($previous_state !== $upgrade->state) {
        UpgradeStateChange::create([
            'upgrade_id' => $upgrade->id,
            'previous_state' => $previous_state,
            'current_state' => $upgrade->state,
        ]);
    }

    return redirect()->route('upgrades.show', ['upgrade' => $upgrade]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upgrade $upgrade)
    {
        //
    }
}