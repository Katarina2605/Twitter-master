<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // On vérifie que l'utilisateur courant est un administrateur
        Gate::authorize('viewAny', User::class);

        // On récupère tous les utilisateurs avec pagination de 10 par page
        $users = User::paginate(10);

        // On passe les utilisateurs à la vue `admin.users.index`
        return view('admin.users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Pas implémenté
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Pas implémenté
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // Pas implémenté
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // On vérifie que l'utilisateur courant est un administrateur
        Gate::authorize('update', $user);

        // On récupère tous les rôles disponibles
        // On utilise la méthode pluck() pour récupérer uniquement le nom des rôles dans un tableau
        $roles = \App\Models\Role::pluck('name');

        // On passe l'utilisateur et les rôles à la vue `admin.users.edit`
        return view('admin.users.edit', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        // On vérifie que l'utilisateur courant est un administrateur
        Gate::authorize('update', $user);

        // Validation du rôle
        $request->validate([
            // On vérifie que le rôle est bien un des rôles définis dans le modèle Role
            'role' => 'required|in:'.implode(',', \App\Models\Role::roles()),
        ]);

        // Mise à jour du rôle
        // On récupère le rôle correspondant au nom du rôle passé dans la requête
        $role = \App\Models\Role::where('name', $request->role)->first();
        // On associe le rôle à l'utilisateur en passant par la relation
        $user->role()->associate($role);
        // On sauvegarde l'utilisateur en base de données
        $user->save();

        // Redirection vers la page de modification de l'utilisateur
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // Pas implémenté
    }
}
