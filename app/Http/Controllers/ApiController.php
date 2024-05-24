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



    public function getAllByUser(Request $request)
    {
        $userId = $request->input('userId');
        
        $upgrades = Upgrade::where('user_id', $userId)->get();
        
        $result = $upgrades->orderBy('id', 'desc')->get(); 
        return response()->json($result);
    }




    public function SortByStateAndZone(Request $request)
    {
        $state = $request->input('state');
        $zone = $request->input('zone');
        $keyword = $request->input('keyword'); 

        $upgrades = Upgrade::where('state', $state);

        if ($zone) {
            $upgrades->where('zone', $zone);
        }

        if ($keyword) {
            $upgrades->where('title', 'like', '%' . $keyword . '%'); 
        }

        $upgrades->orderBy('id', 'desc');

        $result = $upgrades->get();

        return response()->json($result);
    }







    public function getAll(Request $request)
    {
        $upgrades = Upgrade::query();
        $result = $this->filterAndSort($request, $upgrades);

        $result = $upgrades->orderBy('id', 'desc')->get(); 
        return response()->json($result);
    }


    public function getAllValorandose(Request $request)
    {
        $upgrades = Upgrade::where('state', 'Valorandose');
        
        $keyword = $request->input('keyword'); 
        if ($keyword) {
            $upgrades->where('title', 'like', '%' . $keyword . '%');
        }
        
        $result = $upgrades->orderBy('id', 'desc')->get(); 
        return response()->json($result);
    }

    public function getAllEnCurso(Request $request)
    {
        $upgrades = Upgrade::where('state', 'En curso');
        
        $keyword = $request->input('keyword'); 
        if ($keyword) {
            $upgrades->where('title', 'like', '%' . $keyword . '%'); 
        }
        
        $result = $upgrades->orderBy('id', 'desc')->get(); 
        return response()->json($result);
    }

    public function getAllResuelta(Request $request)
    {
        $upgrades = Upgrade::where('state', 'Resuelta');
        
        $keyword = $request->input('keyword'); 
        if ($keyword) {
            $upgrades->where('title', 'like', '%' . $keyword . '%'); 
        }
        
        $result = $upgrades->orderBy('id', 'desc')->get(); 
        return response()->json($result);
    }

    public function getSanitariaZone(Request $request)
    {
        $upgrades = Upgrade::where('zone', 'Sanitaria');
        
        $keyword = $request->input('keyword'); 
        if ($keyword) {
            $upgrades->where('title', 'like', '%' . $keyword . '%'); 
        }
        
        $result = $upgrades->orderBy('id', 'desc')->get();
        return response()->json($result);
    }

    public function getMedicamentosZone(Request $request)
    {
        $upgrades = Upgrade::where('zone', 'Medicamentos');
        
        $keyword = $request->input('keyword');
        if ($keyword) {
            $upgrades->where('title', 'like', '%' . $keyword . '%'); 
        }
        
        $result = $upgrades->orderBy('id', 'desc')->get(); 
        return response()->json($result);
    }

    public function getCalidadZone(Request $request)
    {
        $upgrades = Upgrade::where('zone', 'Control de calidad');
        
        $keyword = $request->input('keyword'); 
        if ($keyword) {
            $upgrades->where('title', 'like', '%' . $keyword . '%'); 
        }
        
        $result = $upgrades->orderBy('id', 'desc')->get(); 
        return response()->json($result);
    }

    public function getCosmeticosZone(Request $request)
    {
        $upgrades = Upgrade::where('zone', 'Cosmeticos');
        
        $keyword = $request->input('keyword');
        if ($keyword) {
            $upgrades->where('title', 'like', '%' . $keyword . '%'); 
        }
        
        $result = $upgrades->orderBy('id', 'desc')->get(); 
        return response()->json($result);
    }


    public function listUpgradesByWord(Request $request)
    {
        $keyword = $request->input('keyword');
        $upgrades = Upgrade::where('title', 'like', '%' . $keyword . '%');

        

        $result = $upgrades->orderBy('id', 'desc')->get(); 
        return response()->json($result);
    }


        public function listUpgradesByStateAndUser(Request $request)
        {
            $state = $request->input('state');
            $userId = $request->input('userId');
            
            $result = Upgrade::where('state', $state)
                            ->where('user_id', $userId)
                            ->orderBy('id', 'desc')
                            ->get(); 

            return response()->json($result);
        }

        public function listUpgradesByZoneAndUser(Request $request)
        {
            $zone = $request->input('zone');
            $userId = $request->input('userId');
            
            $result = Upgrade::where('zone', $zone)
                                ->where('user_id', $userId)
                                ->orderBy('id', 'desc')
                                ->get();
            
            return response()->json($result);
        }


        public function listUpgradesByStateAndZoneAndUser(Request $request)
        {
            $state = $request->input('state');
            $zone = $request->input('zone');
            $userId = $request->input('userId');
            
            $result = Upgrade::where('state', $state)
                                ->where('zone', $zone)
                                ->where('user_id', $userId)
                                ->orderBy('id', 'desc')
                                ->get();
            
            return response()->json($result);
        }

 


        public function getUpgradesByUserId($userId)
        {
            $upgrades = Upgrade::where('user_id', $userId)
                       ->orderBy('id', 'desc')
                       ->get();

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
        
            $upgradeIntermedia = UpgradeIntermedia::where('upgrade_id', $upgradeId)
                                                  ->where('user_id', $userId)
                                                  ->delete();
        
            $likedUpgradeIds = UpgradeIntermedia::where('user_id', $userId)
                                                  ->where('like_pressed', true)
                                                  ->pluck('upgrade_id');
        
            return response()->json($likedUpgradeIds);
        }



        public function storeIntermedia(Request $request)
        {
            $tablaPivote = new UpgradeIntermedia();
            $tablaPivote->like_pressed = $request->like_pressed;
            $tablaPivote->user_id = $request->user_id;
            $tablaPivote->upgrade_id = $request->upgrade_id;
            
            $tablaPivote->save();
        
            $likedUpgradeIds = UpgradeIntermedia::where('user_id', $request->user_id)
                                                ->where('like_pressed', true)
                                                ->pluck('upgrade_id');
        
            return response()->json($likedUpgradeIds);
        }

      

        public function updateLikes(Request $request, $id)
        {
            $upgrade = Upgrade::findOrFail($id);
            $upgrade->likes = $request->input('likes');
            $upgrade->save();

            return response()->json($upgrade, 200);
        }

        public function editUser(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:35', 'regex:/^[a-zA-Z\s]+$/'],
                'surname' => ['required', 'string', 'max:45', 'regex:/^[a-zA-Z\s]+$/'],
            ]);
        
            $user = User::findOrFail($id);
        
            $user->name = $validatedData['name'];
            $user->surname = $validatedData['surname'];
        
            $user->save();
        
            return response()->json($user, 200);
        }



        
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
            $upgrade->title = $validatedData['title'];
            $upgrade->zone = $validatedData['zone'];
            $upgrade->type = $validatedData['type'];
            $upgrade->worry = $validatedData['worry'];
            $upgrade->benefit = $validatedData['benefit'];
            $upgrade->state = 'Valorandose';
            $upgrade->likes = 0;
            $upgrade->user_id = $request->user_id; 


            $upgrade->save();
        
            return response()->json($upgrade);
        }



    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'zone' => 'required|string', 
            'type' => 'required|string',
            'worry' => 'required|string',
            'benefit' => 'required|string',
        ]);

        $upgrade = Upgrade::find($id);

        if (!$upgrade) {
            return response()->json(['error' => 'Actualización no encontrada'], 404);
        }

        if ($upgrade->state !== 'Valorandose') {
            return response()->json(['error' => 'No se puede actualizar. El estado no es Valorandose'], 400);
        }

        $upgrade->title = $validatedData['title'];
        $upgrade->zone = $validatedData['zone'];
        $upgrade->type = $validatedData['type'];
        $upgrade->worry = $validatedData['worry'];
        $upgrade->benefit = $validatedData['benefit'];

        $upgrade->save();

        return response()->json($upgrade);
    }


}