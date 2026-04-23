<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
//use App\Models\Article;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    // Función para mostrar los articulos escritos por autores
    public function show(Profile $profile) {
        // USAR LA RELACIÓN (más limpio y mantenible)
        $articles = $profile->user->articles()
            ->where('status', '1')
            ->simplePaginate(8);
        // Retornando la vista con la data enviada
        return view('subscriber.profiles.show', compact('profile', 'articles'));
    }
    // Función para mostrar el formulario de editar perfil
    public function edit(Profile $profile)
    {
        // Verificar que sea el dueño del perfil
        if(Auth::id() !== $profile->user_id) {
            abort(403);
        }

        return view('subscriber.profiles.edit', compact('profile'));
    }
    //Función para aplicar la modificación de datos del perfil
    public function update(ProfileRequest $request, Profile $profile)
    {
        // Verificar que sea el dueño del perfil
        if(Auth::id() !== $profile->user_id) {
            abort(403);
        }

        $user = Auth::user();

        if($request->hasFile('photo')) {
            // Eliminar foto si en caso de que exista
            if($profile->photo) {
                File::delete(public_path('storage/' . $profile->photo));
            }
            // Asignar nueva foto
            $photo = $request['photo']->store('profiles');
        } else {
            $photo = $user->profile->photo;
        }

        // Actualizar usuario 
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        // Aplicar cambios
        $user->save();

        // Actualizar perfil
        // 1. Asignar foto
        $user->profile->photo = $photo;
        // 2. Asignar campos adicionales 
        $user->profile->profession = $request->profession;
        $user->profile->about = $request->about;
        $user->profile->twitter = $request->twitter;
        $user->profile->linkedin = $request->linkedin;
        $user->profile->facebook = $request->facebook;
        // Aplicar cambios
        $user->profile->save();

        // Mensaje de éxito
        return redirect()->route('profiles.edit', $user->profile->id)
                         ->with('success', 'Perfil actualizado correctamente');
    }
}
