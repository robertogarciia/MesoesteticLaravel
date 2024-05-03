<?php

namespace App\Http\Controllers;

use App\Models\Upgrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        
        $upgrades = Upgrade::all(); 
        $upgrades = Upgrade::orderBy('created_at', 'desc')->get(); // Get all upgrades from the database

        return view('indexUpgrades', ['upgrades' => $upgrades]);

    }
    public function upgradesCount() {
        // Cuenta el número de mejoras por estado
        $countUpgrades = [
            'Valorandose' => Upgrade::where('state', 'Valorandose')->count(),
            'En_curso' => Upgrade::where('state', 'En curso')->count(),
            'Resuelta' => Upgrade::where('state', 'Resuelta')->count(),
        ];

        // Calcular los porcentajes de cada estado respecto al total de mejoras
        $totalMejoras = Upgrade::count(); 
        $percentages = [
            'Valorandose' => ($totalMejoras > 0) ? ($countUpgrades['Valorandose'] / $totalMejoras) * 100 : 0,
            'En_Curso' => ($totalMejoras > 0) ? ($countUpgrades['En_curso'] / $totalMejoras) * 100 : 0,
            'Resuelta' => ($totalMejoras > 0) ? ($countUpgrades['Resuelta'] / $totalMejoras) * 100 : 0,
        ];

        return view('principalPage', compact('countUpgrades', 'percentages'));
    }

    public function changesData() {
        // Número de mejoras que han cambiado de estado
        $stateChangeCounts = [
            'Valorándose' => Upgrade::where('state', 'Valorándose')->count(),
            'En_curso' => Upgrade::where('state', 'En curso')->count(),
            'Resuelta' => Upgrade::where('state', 'Resuelta')->count(),
        ];

        // Calcula el tiempo medio en que las mejoras cambian de estado
        $upgradeTimes = Upgrade::selectRaw('state, AVG(TIMESTAMPDIFF(DAY, created_at, updated_at)) as avg_time')
                                ->groupBy('state')
                                ->pluck('avg_time', 'state'); 

        return view('principalPage', compact('stateChangeCounts', 'upgradeTimes'));
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
        $user = Auth::user();
        return view('showUpgrades',['Upgrade'=>$upgrade, 'user'=>$user]);

    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Upgrade $upgrade)
    {
        $user = Auth::user();
        


        if (strpos($user->email, 'admin') === 0) {
            return view('editAdminUpgrade', ['upgrade' => $upgrade]);
        } else {
            return view('editupgrade', ['upgrade' => $upgrade]);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Upgrade $upgrade)
{
    // Estado anterior
    $upgrade->update($request->all());


    return redirect()->route('upgrades.show', ['upgrade' => $upgrade]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Upgrade $upgrade)
    {
        //
    }

    public function filterByZone($zone)
{
    // Aquí pots recuperar les millores de la base de dades segons la zona seleccionada
    $upgrades = Upgrade::where('zone', $zone)->get();
    
    // Això retorna les millores a una vista específica. Potser voldràs ajustar això a les teves necessitats.
    return view('indexUpgrades', compact('upgrades'));
}

public function getMyUpgrades() {
    // Aquí obtenemos las actualizaciones del usuario actual
    $userId = Auth::user()->id;
    $userUpgrades = Upgrade::where('user_id', $userId)->orderBy('created_at', 'desc')->get();

    // Renderizamos la vista 'indexUpgrades' con las actualizaciones del usuario
    return view('indexUpgrades', ['upgrades' => $userUpgrades]);
}



    
}