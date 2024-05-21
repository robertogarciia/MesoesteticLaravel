<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upgrade;
use App\Models\upgradeIntermedia;

use App\Models\User;
use Illuminate\Support\Facades\Auth;




class ApiController extends Controller
{


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json($user, 200);
        }
       

        return response()->json(['message' => 'Unauthorized'], 401);
    }


    public function getUserById($id)
{
    $user = User::find($id);

    if (!$user) {
        $user -> id = -1;
        return response()->json($user, 404);
    }

    return response()->json($user);
}


    public function getUsers()
    {

        $users = User::all(); // Get all users from the database
        
        return response()->json($users);

    }

    public function getAllByUser(Request $request)
    {
    $userId = $request->input('userId');
    
    $upgrades = Upgrade::where('user_id', $userId)->get();
    
    return response()->json($upgrades);
    }


    public function getAll()
    {
        $upgrades = Upgrade::all(); 

        return response()->json(
           
            $upgrades
        );
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
   
    
    // Crea una nueva Upgrade con los datos recibidos
    $upgrade = new Upgrade();
    $upgrade->title = $request->title;
    $upgrade->zone = $request->zone;
    $upgrade->type = $request->type;
    $upgrade->worry = $request->worry;
    $upgrade->benefit = $request->benefit;
    $upgrade->state = 'Valorandose';
    $upgrade->likes = 0;    
    $upgrade->user_id = $request->user_id; 
    
    // Guarda la Upgrade en la base de datos
    $upgrade->save();


    // Retorna una respuesta JSON con los datos de la Upgrade recién creada
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

    // Actualiza los campos de Upgrade
    $upgrade->fill($request->only(['title', 'zone', 'type', 'worry', 'benefit', 'likes']));

    // Guarda los cambios en Upgrade
    $upgrade->save();

    // Actualiza la tabla pivote
    if ($request->has('likedBoolean') && $request->has('userId')) {
        $userId = $request->input('userId'); // Obtén el ID del usuario del cuerpo de la solicitud
        $upgradeId = $request->input('upgradeId');
        $likePressed = $request->input('likedBoolean');
        
        $upgrade->users()->sync([$userId => ['like_pressed' => $likePressed]], false); // El segundo parámetro false evita eliminar otros registros de la tabla pivote
    }

    return response()->json($upgrade);
}


/*
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
    if ($request->has('likes')) {
        $upgrade->likes = $request->input('likes');
    }
    if ($request->has('likedBoolean')) {
        $upgrade->likes = $request->input('likedBoolean');
    }
    if ($request->has('benefit')) {
        $upgrade->benefit = $request->input('benefit');
    }

    $upgrade->save();

    return response()->json($upgrade);
}
*/
public function destroy($id)
{
    $upgrade = Upgrade::find($id);

    if (!$upgrade) {
        return response()->json(['error' => 'Actualización no encontrada'], 404);
    }

    $upgrade->delete();

    return response()->json(['message' => 'Actualización eliminada correctamente']);
}


public function listUpgradesByWord(Request $request)
{
    
    $keyword = $request->input('keyword'); 

    $upgrades = Upgrade::where('title', 'like', '%' . $keyword . '%');


    $direction = $request->input('direction', 'asc');
    $upgrades->orderBy('zone', $direction);

    $result = $upgrades->get();

    return response()->json($result);
}

        public function listUpgradesByStateAndUser(Request $request)
        {
            $state = $request->input('state');
            $userId = $request->input('userId');
            
            $upgrades = Upgrade::where('state', $state)
                                ->where('user_id', $userId)
                                ->get();
            
            return response()->json($upgrades);
        }

        public function listUpgradesByZoneAndUser(Request $request)
        {
            $zone = $request->input('zone');
            $userId = $request->input('userId');
            
            $upgrades = Upgrade::where('zone', $zone)
                                ->where('user_id', $userId)
                                ->get();
            
            return response()->json($upgrades);
        }


        public function listUpgradesByStateAndZoneAndUser(Request $request)
        {
            $state = $request->input('state');
            $zone = $request->input('zone');
            $userId = $request->input('userId');
            
            $upgrades = Upgrade::where('state', $state)
                                ->where('zone', $zone)
                                ->where('user_id', $userId)
                                ->get();
            
            return response()->json($upgrades);
        }

        public function getUpgradeCountByStateForUser(Request $request)
        {
            // Obtenemos el userId de la solicitud
            $userId = $request->input('userId');
        
            // Realiza la búsqueda según el $userId proporcionado
            $countValorandose = Upgrade::where('state', 'Valorandose')
                                        ->where('user_id', $userId)
                                        ->count();
        
            $countEnCurso = Upgrade::where('state', 'En curso')
                                    ->where('user_id', $userId)
                                    ->count();
        
            $countResuelta = Upgrade::where('state', 'Resuelta')
                                    ->where('user_id', $userId)
                                    ->count();
        
            // Calcula el total de actualizaciones
            $totalCount = $countValorandose + $countEnCurso + $countResuelta;
        
            // Retorna la respuesta JSON con el recuento de actualizaciones por estado
            return response()->json([
                'Valorandose' => $countValorandose,
                'En Curso' => $countEnCurso,
                'Resuelta' => $countResuelta,
                'Total' => $totalCount
            ]);
        }



        public function getUpgradesByUserId($userId)
        {
            $upgrades = Upgrade::where('user_id', $userId)->get();
        
            return response()->json($upgrades);
        }
        


        public function getUserLikedUpgrades($userId)
        {
            $likedUpgradeIds = UpgradeIntermedia::where('user_id', $userId)
                                                ->where('like_pressed', true)
                                                ->pluck('upgrade_id');

            return response()->json($likedUpgradeIds);
        }


        public function deleteUpgradeIntermedia(Request $request)
        {
            $upgradeId = $request->input('upgrade_id');
            $userId = $request->input('user_id');
        
            // Eliminar el registro
            $upgradeIntermedia = UpgradeIntermedia::where('upgrade_id', $upgradeId)
                                                  ->where('user_id', $userId)
                                                  ->delete();
        
            // Recuperar la lista actualizada de IDs de actualizaciones que le gustan al usuario
            $likedUpgradeIds = UpgradeIntermedia::where('user_id', $userId)
                                                  ->where('like_pressed', true)
                                                  ->pluck('upgrade_id');
        
            return response()->json($likedUpgradeIds);
        }



        public function storeIntermedia(Request $request)
        {
            // Crea un nuevo registro en la tabla UpgradeIntermedia
            $tablaPivote = new UpgradeIntermedia();
            $tablaPivote->like_pressed = $request->like_pressed;
            $tablaPivote->user_id = $request->user_id;
            $tablaPivote->upgrade_id = $request->upgrade_id;
            
            // Guarda el registro en la base de datos
            $tablaPivote->save();
        
            // Recupera la lista actualizada de IDs de actualizaciones que le gustan al usuario
            $likedUpgradeIds = UpgradeIntermedia::where('user_id', $request->user_id)
                                                ->where('like_pressed', true)
                                                ->pluck('upgrade_id');
        
            // Retorna una respuesta JSON con los datos el nuevo registro en la tabla intermedia y la lista actualizada de IDs
            return response()->json($likedUpgradeIds);
        }

      

        public function updateLikes(Request $request, $id)
        {
            $upgrade = Upgrade::findOrFail($id);
            $upgrade->likes = $request->input('likes');
            $upgrade->save();

            return response()->json($upgrade, 200);
        }


}