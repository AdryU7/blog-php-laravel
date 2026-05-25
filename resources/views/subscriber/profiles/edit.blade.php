@extends('layouts.base') <!-- Heredando del layout base -->
<!-- Importando estilos mediante un section -->
@section('styles') <!-- Se aplico vite para obtener y renderizar los estilos en tiempo real -->
    @vite(['resources/css/user/profiles/css/style_profile.css'])
@endsection
<!-- Colocando el titulo a la página -->
@section('title', 'Editar Perfil')
<!-- Inicia los bloques para colocar el contenido -->
@section('content')

<div class="btn-article">
    <!-- Se cambió la ruta para devolver la vista que muestra el perfil de usuario -->
    <a href="{{ route('profiles.show', $profile) }}" class="btn-new-article">⬅</a>
</div>

<div class="main-content">
    <div class="title-page-admin">
        <h2>Editar Perfil</h2>
    </div>
    <!-- Indicando la ruta para que aplique el método de actualizar un perfil del usuario desde el controlador -->
    <form method="POST" action="{{ route('profiles.update', $profile) }}" enctype="multipart/form-data"
        class="form-article">
        @csrf <!-- Token para verificar si el usuario autenticado va a realizar una solicitud -->
        @method('PUT') <!-- Indicar que el método sea PUT ya que se va a actualizar los datos existentes en el sistema -->
        <div class="content-create-article">
            <!-- CAMPOS PRINCIPALES -->
            <!-- Nombre del usuario -->
            <div class="input-content">
                <label for="name">Nombre completo</label>
                <input type="text" name="full_name"
                placeholder="Escribe tu nombre completo"
                value="{{ $profile->user->full_name }}" autofocus> <!-- Dar como valor el campo definido en el controlador -->
                <!-- Mensaje de error -->
                @error('full_name')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>
            <!-- Correo del usuario -->
            <div class="input-content">
                <label for="email">Correo electrónico</label>
                <input type="text" name="email" placeholder="ejemplo@dominio.com"
                value="{{ $profile->user->email }}" autofocus> <!-- Dar como valor el campo definido en el controlador -->
                <!-- Mensaje de error -->
                @error('email')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror

            </div>
            <!-- Foto de perfil del usuario -->
            <div class="input-content">
                <label for="image">Foto de perfil</label> <br>
                <input type="file" id="photo" accept="image/*" name="photo" class="form-input-file">
                <!-- Condición para indicar si el perfil dispone de una foto -->
                @if($profile->photo)
                <label>Foto actual</label>
                <div class="img-article">
                    <!-- Mostrar la foto almacenada en el sistema -->
                    <img src="{{ asset('storage/' . $profile->photo) }}" class="img">
                </div>
                <!-- Mensaje de error -->
                @error('photo')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
                @endif <!-- Fin de la condición -->
            </div>
            <!-- SE AÑADIERON CAMPOS ADICIONALES -->
            <!-- Profesión del perfil de usuario -->
            <div class="input-content">
                <label for="profession">Profesión</label>
                <input type="text" name="profession" placeholder="Escribe tu profesión"
                value="{{ $profile->user->profession }}" autofocus> <!-- Dar como valor el campo definido en el controlador -->
                <!-- Mensaje de error -->
                @error('profession')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
            </div>
            <!-- Información sobre el perfil de usuario -->
            <div class="input-content">
                <label for="about">Sobre mí</label>
                <input type="text" name="about" placeholder="Cuéntanos un poco sobre tí"
                value="{{ $profile->user->about }}" autofocus> <!-- Dar como valor el campo definido en el controlador -->
                <!-- Mensaje de error -->
                @error('about')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
            </div>
            <!-- Enlace de Facebook del perfil de usuario -->
            <div class="input-content">
                <label for="facebook">Facebook</label>
                <input type="text" name="facebook" placeholder="Comparte tu enlace de Facebook"
                value="{{ $profile->user->facebook }}" autofocus> <!-- Dar como valor el campo definido en el controlador -->
                <!-- Mensaje de error -->
                @error('facebook')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
            </div>
            <!-- Enlace de Twitter del perfil de usuario -->
            <div class="input-content">
                <label for="twitter">Twitter</label>
                <input type="text" name="twitter" placeholder="Comparte tu enlace de Twitter"
                value="{{ $profile->user->twitter }}" autofocus> <!-- Dar como valor el campo definido en el controlador -->
                <!-- Mensaje de error -->
                @error('twitter')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
            </div>
            <!-- Enlace de Linkedin del perfil de usuario -->
            <div class="input-content">
                <label for="linkedin">Linkedin</label>
                <input type="text" name="linkedin" placeholder="Comparte tu enlace de Linkedin"
                value="{{ $profile->user->linkedin }}" autofocus> <!-- Dar como valor el campo definido en el controlador -->
                <!-- Mensaje de error -->
                @error('linkedin')
                <span class="text-danger">
                    <span>* {{ $message }}</span>
                </span>
                @enderror
            </div>

            <input type="submit" value="Editar perfil" class="button">
    </form>
</div>
@endsection <!-- Fin de los bloques del contenido -->