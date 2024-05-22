<?php

namespace App\Http\Controllers;

use App\Models\Upgrade;
use App\Models\User;
use App\Models\upgradeIntermedia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use DB;

class UpgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index(Request $request)
{
    $sort_by = $request->input('sort_by', 'created_at');
    $sort_direction = $request->input('sort_direction', 'desc');
    $state = urldecode($request->input('state', 'todos'));
    $zone = urldecode($request->input('zone', 'todos'));
    $start_date = $request->input('start_date', null);
    $end_date = $request->input('end_date', null);
    $search = $request->input('search', null);

    $query = Upgrade::orderBy($sort_by, $sort_direction);

    if ($state !== 'todos') {
        $query->where('state', $state);
    }

    if ($zone !== 'todos') {
        $query->where('zone', $zone);
    }

    if ($start_date && $end_date) {
        $start = Carbon::parse($start_date)->startOfDay();
        $end = Carbon::parse($end_date)->endOfDay();

        if ($start->gt($end)) {
            return back()->withErrors(['error' => 'La fecha de inicio no puede ser posterior a la fecha de fin']);
        }

        $query->whereBetween('created_at', [$start, $end]);
    }

    if ($search) {
        $query->where('title', 'like', "%$search%");
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
        'state' => $state,
        'zone' => $zone,
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
   public function dashboardData() {
        // Cuenta el número de mejoras por estado
        $countUpgrades = [
            'Valorandose' => Upgrade::where('state', 'Valorandose')->count(),
            'En_curso' => Upgrade::where('state', 'En curso')->count(),
            'Resuelta' => Upgrade::where('state', 'Resuelta')->count(),
        ];
    
        // Calcular los porcentajes de cada estado respecto al total de mejoras
        $totalMejoras = array_sum($countUpgrades);
        $percentages = [
            'Valorandose' => ($totalMejoras > 0) ? ($countUpgrades['Valorandose'] / $totalMejoras) * 100 : 0,
            'En_Curso' => ($totalMejoras > 0) ? ($countUpgrades['En_curso'] / $totalMejoras) * 100 : 0,
            'Resuelta' => ($totalMejoras > 0) ? ($countUpgrades['Resuelta'] / $totalMejoras) * 100 : 0,
        ];
    
        // Calcula el tiempo medio en que las mejoras cambian de estado
        $upgradeTimes = Upgrade::selectRaw('state, AVG(TIMESTAMPDIFF(DAY, created_at, updated_at)) as avg_time')
                                ->groupBy('state')
                                ->pluck('avg_time', 'state');
    
        // Obtener número de mejoras por mes y estado
        $upgradesPerMonth = Upgrade::selectRaw('MONTH(updated_at) as month, MONTHNAME(updated_at) as month_name, state, COUNT(*) as count')
                                    ->groupBy('month', 'month_name', 'state')
                                    ->orderBy('month')
                                    ->get();
    
        // Formatear los datos para el gráfico mensual
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        $monthlyData = [];
        foreach ($months as $month) {
            $monthlyData['Valorandose'][$month] = 0;
            $monthlyData['En_curso'][$month] = 0;
            $monthlyData['Resuelta'][$month] = 0;
        }
    
        foreach ($upgradesPerMonth as $data) {
            $monthlyData[$data->state][$data->month_name] = $data->count;
        }
        // Obtenir els usuaris amb el nombre d'upgrades creats
        $userUpgrades = User::withCount('upgrades')
            ->orderBy('upgrades_count', 'desc')
            ->take(10)
            ->get();

        // Calcular la tendència mensual de millores resoltes
        $monthlyTrends = Upgrade::select(
            DB::raw('YEAR(updated_at) as year'), 
            DB::raw('MONTH(updated_at) as month'),
            DB::raw('count(*) as count')
        )
        ->where('state', 'Resuelta')
        ->groupBy('year', 'month')
        ->orderBy('year', 'asc')
        ->orderBy('month', 'asc')
        ->get()
        ->groupBy(function($date) {
            return Carbon::createFromDate($date->year, $date->month, 1)->format('Y-m');
        });

        $monthLabels = [];
        $monthlyCounts = [];

        foreach ($monthlyTrends as $month => $values) {
            $monthLabels[] = $month;
            $monthlyCounts[] = $values->sum('count');
        }

        return view('principalPage', compact('countUpgrades', 'percentages', 'userUpgrades', 'monthLabels', 'monthlyCounts'));
    
        
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


public function search(Request $request)
{
    $search = $request->input('search');
    $results = Upgrade::where('title', 'like', "%$search%")->get();

    return view('indexUpgrades', ['results' => $results]);
}

}