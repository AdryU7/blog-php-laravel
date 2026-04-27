<form method="POST" class="form" action="#" novalidate>
    <h2>Crear cuenta</h2>
    <div class="content-login">
        <div class="input-content">
            <input type="text" name="full_name" placeholder="Nombre completo"
                value="" 
                autofocus>

            <span class="text-danger">
                <span>*</span>
            </span>

        </div>

        <div class="input-content">
            <input type="text" name="email" placeholder="Correo eléctronico"
                value="" 
                autofocus>

            <span class="text-danger">
                <span>*</span>
            </span>

        </div>

        <div class="input-content">
            <input type="password" name="password" placeholder="Contraseña">

            <span class="text-danger">
                <span>*</span>
            </span>

        </div>

        <div class="input-content">
            <input type="password" name="password_confirmation" placeholder="Confirmar contraseña">
        </div>
    </div>

    <input type="submit" value="Registrarse" class="button">
    <p>¿Ya tienes una cuenta? <a href="#" class="link">Iniciar sesión</a></p>
</form>

