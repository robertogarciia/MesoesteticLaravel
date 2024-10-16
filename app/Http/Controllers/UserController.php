<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Obtener los parámetros de filtro y ordenado de la solicitud
    $post = $request->input('post');
    $sortOrder = $request->input('sort_order', 'asc');
    $search = $request->input('search');

    // Construir la consulta con filtros y ordenado
    $query = User::query();

    if ($post !== null) {
        $query->where('post', $post);
    }

    if ($search) {
        $query->where(function ($query) use ($search) {
            $query->where('email', 'like', "%{$search}%")
                ->orWhere('name', 'like', "%{$search}%");
        });
    }

    $query->orderBy('name', $sortOrder);

    // Paginar los resultados
    $users = $query->paginate(20);

    return view('indexUsers', ['users' => $users]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname'=> 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'post' => 'required',
        ]);
        $usuario = new User;
        $usuario->name = $request->input('name');
        $usuario->surname = $request->input('surname');
        $usuario->email = $request->input('email');
        $usuario->password = bcrypt($request->input('password'));
        $usuario->post = $request->input('post');
        $usuario->save();

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('editUser', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if (!$user) {
            return redirect()->back()->with('error', '¡Usuario no encontrado!');
        }
        $user->delete();
        return redirect()->back()->with('success', '¡Usuario eliminado correctamente!');
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $results = User::where('email', 'like', "%$search%")->get();
        return view('indexusers', ['results' => $results]);
    }
    
}
