@extends('layouts.base') <!-- Heredando del layout base -->
<!-- Importando estilos mediante un section -->
@section('styles') <!-- Se aplico vite para obtener y renderizar los estilos en tiempo real -->
    @vite(['resources/css/user/css/style_user.css',
        'resources/css/user/profiles/css/article_profile.css'])
@endsection <!-- Fin de la section de estilos -->
<!-- Colocando el titulo a la página -->
@section('title', 'Perfil')
<!-- Inicia los bloques para colocar el contenido -->
@section('content')
<!-- Condición para mostrar un mensaje en caso de que el usuario haya actualizado su perfil -->
@if(session('success-update'))
<div class="alert-session">
    <h3 style="color: #1d448e">
        ✔ {{ session('success-update') }}
    </h3>
</div>
@endif

<div class="description-profile">

    <div class="image-profile">
        <!-- Parámetro para acceder a la información del usuario utilizando variables del método show -->
        <img src="{{ $profile->photo ? asset('storage/'.$profile->photo) : asset('img/user-default.png') }}">
    </div>

    <div class="body-description-profile">
        <!-- Código para acceder al nombre del usuario -->
        <p>Nombre: {{ $profile->user->full_name }}</p>
        <!-- Código para acceder a la profesión del usuario -->
        <p>Profesion: <i>{{ $profile->profession ?? 'No contiene' }}</i></p>
        <!-- Código para acceder a la información del usuario -->
        <p>Sobre mi: <i>{{ $profile->about ?? 'No contiene' }}</i></p>
        <div class="extra">
            <!-- Enlaces de las redes sociales -->
            {{-- Código para llamar a la url de la cuenta de Facebook del usuario --}}
            <a href="{{ $profile->facebook }}" target="_blank" class="social">Facebook</a>
            {{-- Código para llamar a la url de la cuenta de Twitter del usuario --}}
            <a href="{{ $profile->twitter }}" target="_blank" class="social">Twitter</a>
            {{-- Código para llamar a la url de la cuenta de Linkedin del usuario --}}
            <a href="{{ $profile->linkedin }}" target="_blank" class="social">Linkedin</a>
        </div>
    </div>
    <!-- Aplicando la condición para verificar si el perfil del usuario coincide con su ID
    y que muestre el boton de Editar Perfil en caso de que la condición SÍ cumpla -->
    @if ($profile->user_id == Auth::user()->id)
    <div class="edit-profile-view">
        <!-- Colocando la ruta para que redireccione a la vista de Editar Perfil -->
        <a href="{{ route('profiles.edit', $profile) }}">Editar Perfil</a>
    </div>
    @endif
</div>

<div class="text-article">
    <h2 class="mb-5">Artículos publicados</h2>
</div>
<!-- Aplicando la condición para verificar si el perfil del usuario tiene artículos publicados -->
@if( count($articles) > 0)
 <!-- Listar artículos -->
<div class="article-container">
    <!-- Arreglo con un foreach para listar los articulos -->
    @foreach($articles as $article)
    <article class="article">
        <!-- Código para obtener las imágenes de cada artículo -->
        <img src="{{ asset('storage/' . $article->image) }}" class="img">
        <div class="card-body">
            <!-- Colocando la ruta para mostrar un artículo seleccionado -->
            <a href="{{ route('articles.show', $article) }}">
                <!-- Obteniendo el tíulo del artículo con un límite de caracteres -->
                <h2 class="title">{{ Str::limit($article->title, 70, '...') }}</h2>
            </a>
        </div>
    </article>
    <!-- Fin del arreglo foreach -->
    @endforeach
</div>
<!-- Continuando la condición en caso de que no haya publicado ningún articulo -->
@else
<!-- Indicar mediante un texto que no existe ningún articulo publicado -->
<div class="text-article">
    <p>El usuario no ha publicado ningún artículo.</p>
</div>
<!-- Fin de la condición -->
@endif
<div class="links-paginate-profile">
    <!-- Mostrando un paginador de los artículos del usuario -->
    {{ $articles->links() }}
</div>
<!-- Fin de los bloques del contenido -->
@endsection