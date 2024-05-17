<?php

namespace App\Http\Controllers;

use App\Models\Upgrade;
use App\Models\upgradeIntermedia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UpgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort_by = $request->input('sort_by', 'created_at');
        $sort_direction = $request->input('sort_direction', 'desc');
        $estado = urldecode($request->input('state', 'todos'));
        $zona = urldecode($request->input('zone', 'todos'));
        $start_date = $request->input('start_date', null);
        $end_date = $request->input('end_date', null);
    
        $query = Upgrade::orderBy($sort_by, $sort_direction);
    
        // Filter by zone (if not 'todos')
        if ($zona !== 'todos') {
            $query->where('zone', $zona);
        }
    
        // Filter by state (if not 'todos')
        if ($estado !== 'todos') {
            $query->where('state', $estado);
        }
    
        // Filter by dates (if both values are defined)
        if ($start_date && $end_date) {
            $start = Carbon::parse($start_date)->startOfDay();
            $end = Carbon::parse($end_date)->endOfDay();
    
            if ($start->gt($end)) {
                return back()->withErrors(['error' => 'La fecha de inicio no puede ser posterior a la fecha de fin']);
            }
    
            $query->whereBetween('created_at', [$start, $end]);
        }
    
        $upgrades = $query->paginate(10);
        
        $totalPages = $upgrades->lastPage(); 
        $currentPage = $upgrades->currentPage(); 
        $pagesToShow = 5;
    
        
        $startPage = max(1, $currentPage - intdiv($pagesToShow, 2)); 
        $endPage = min($totalPages, $currentPage + intdiv($pagesToShow, 2)); 
    
        
        if ($endPage - $startPage < $pagesToShow - 1) {
            if ($currentPage <= intdiv($pagesToShow, 2)) {
                $endPage = min($pagesToShow, $totalPages);
            } else {
                $startPage = max(1, $totalPages - $pagesToShow + 1);
            }
        }
    
        
        return view('indexUpgrades', [
            'upgrades' => $upgrades,
            'sort_by' => $sort_by,
            'sort_direction' => $sort_direction,
            'state' => $estado,
            'zone' => $zona,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'startPage' => $startPage, 
            'endPage' => $endPage,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages 
        ]);
    }
    public function getMyUpgrades() {
        // Aquí obtenemos las actualizaciones del usuario actual
        $userId = Auth::user()->id;
        
        $userUpgrades = Upgrade::where('user_id', $userId)->orderBy('created_at', 'desc')->paginate(10);
    
        // Renderizamos la vista 'indexUpgrades' con las actualizaciones del usuario
        return view('indexUpgrades', ['upgrades' => $userUpgrades]);
    }
    
    public function filterDate(Request $request){
        
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $upgrades = Upgrade::whereBetween('created_at', [$start_date, $end_date])->paginate(10);

        return view('indexUpgrades', compact('upgrades'));
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
    $upgrades = Upgrade::where('zone', $zone)->paginate(10);
    
    // Això retorna les millores a una vista específica. Potser voldràs ajustar això a les teves necessitats.
    return view('indexUpgrades', compact('upgrades'));
}



// App\Http\Controllers\UpgradeController.php

// ...

public function search(Request $request)
{
    $query = $request->input('query');
    $estado = urldecode($request->input('state', 'todos'));
    $zona = urldecode($request->input('zone', 'todos'));
    $start_date = $request->input('start_date', null);
    $end_date = $request->input('end_date', null);

    // Empezar la consulta de Upgrade
    $upgradesQuery = Upgrade::query();

    // Filtrar por estado si no es 'todos'
    if ($estado !== 'todos') {
        $upgradesQuery->where('state', $estado);
    }

    // Filtrar por zona si no es 'todos'
    if ($zona !== 'todos') {
        $upgradesQuery->where('zone', $zona);
    }

    // Filtrar por fechas si están definidas
    if ($start_date && $end_date) {
        $upgradesQuery->whereBetween('created_at', [$start_date, $end_date]);
    }

    // Aplicar la búsqueda por título
    $upgradesQuery->where('title', 'like', '%' . $query . '%');

    // Obtener los resultados
    $upgrades = $upgradesQuery->get();

    // Retornar una respuesta JSON solo con los datos de las mejoras
    return response()->json($upgrades);
}



}