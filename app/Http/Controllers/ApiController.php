<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upgrade;
use App\Models\User;
use Illuminate\Support\Facades\Auth;




class ApiController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['user' => $user], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }


    public function getUserById($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    return response()->json(['user' => $user], 200);
}


    public function getUsers()
    {

        $users = User::all(); // Get all users from the database
        
        return response()->json([
           
            'users' => $users
        ]);

    }



    public function getAll()
    {
        $upgrades = Upgrade::all(); 

        return response()->json([
           
            'upgrades' => $upgrades
        ]);
    }

    public function getAllValorandose()
    {
        $upgrades = Upgrade::where('state', 'Valorandose')->get();
        return response()->json($upgrades);
    }

    public function getAllEnCurso()
    {
        $upgrades = Upgrade::where('state', 'En curso')->get();
        return response()->json($upgrades);
    }

    public function getAllResuelta()
    {
        $upgrades = Upgrade::where('state', 'Resuelta')->get();
        return response()->json($upgrades);
    }

    public function getSanitarioZone()
    {
        $upgrades = Upgrade::where('zone', 'Sanitaria')->get();
        return response()->json($upgrades);
    }

    public function getMedicamentosZone()
    {
        $upgrades = Upgrade::where('zone', 'Medicamentos')->get();
        return response()->json($upgrades);
    }

    public function getCalidadZone()
    {
        $upgrades = Upgrade::where('zone', 'Control de calidad')->get();
        return response()->json($upgrades);
    }

    public function getCosmeticosZone()
    {
        $upgrades = Upgrade::where('zone', 'Cosmeticos')->get();
        return response()->json($upgrades);
    }

    public function listUpgradesByState(Request $request)
    {
        $state = $request->input('state');
        $zone = $request->input('zone');
        
        $upgrades = Upgrade::where('state', $state);
        
        if ($zone) {
            $upgrades->where('zone', $zone);
        }
        
        $direction = $request->input('direction', 'asc');
        $upgrades->orderBy('zone', $direction);
        
        $result = $upgrades->get();
        
        return response()->json($result);
    }


    public function store(Request $request)
    {
        
        $upgrade = new Upgrade();
        $upgrade->title = $request->title;
        $upgrade->zone = $request->zone;
        $upgrade->type = $request->type;
        $upgrade->worry = $request->worry;
        $upgrade->benefit = $request->benefit;
        $upgrade->state = 'Valorandose';
        $upgrade->likes = 0;    
        $upgrade->user_id = 1; 
        
        $upgrade->save();

        return response()->json($upgrade);
    }


    public function updateAdmin(Request $request, $id)
{
    $upgrade = Upgrade::find($id);

    if (!$upgrade) {
        return response()->json(['error' => 'Actualización no encontrada'], 404);
    }

    if ($request->has('state')) {
        $state = $request->input('state');

        if (!in_array($state, ['Valorandose', 'En curso', 'Resuelta'])) {
            return response()->json(['error' => 'Estado no válido'], 400);
        }
        $upgrade->state = $state;
        $upgrade->save();
    }

    return response()->json($upgrade);
}


public function update(Request $request, $id)
{
    $upgrade = Upgrade::find($id);

    if (!$upgrade) {
        return response()->json(['error' => 'Actualización no encontrada'], 404);
    }

    if ($upgrade->state !== 'Valorandose') {
        return response()->json(['error' => 'No se puede actualizar. El estado no es Valorandose'], 400);
    }

    if ($request->has('title')) {
        $upgrade->title = $request->input('title');
    }
    if ($request->has('zone')) {
        $upgrade->zone = $request->input('zone');
    }
    if ($request->has('type')) {
        $upgrade->type = $request->input('type');
    }
    if ($request->has('worry')) {
        $upgrade->worry = $request->input('worry');
    }
    if ($request->has('benefit')) {
        $upgrade->benefit = $request->input('benefit');
    }

    $upgrade->save();

    return response()->json($upgrade);
}

public function destroy($id)
{
    $upgrade = Upgrade::find($id);

    if (!$upgrade) {
        return response()->json(['error' => 'Actualización no encontrada'], 404);
    }

    $upgrade->delete();

    return response()->json(['message' => 'Actualización eliminada correctamente']);
}


}