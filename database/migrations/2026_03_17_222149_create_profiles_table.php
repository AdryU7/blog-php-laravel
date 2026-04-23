<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // Foto de perfil
            $table->string('photo', 255)->nullable()
                ->comment('Directorio de la foto de perfil del usuario');
            // Profesión con validación de longitud
            $table->string('profession', 60)->nullable()
                ->comment('Profesión u ocupación actual del usuario');
            // Descripción personal
            $table->string('about', 255)->nullable()
                ->comment('Breve descripción o biografía del usuario');
            // Redes sociales con validaciones
            $table->string('twitter', 100)->nullable()
                ->comment('Usuario de Twitter (formato: @usuario)');
            $table->string('linkedin', 100)->nullable()
                ->comment('URL completa del perfil de LinkedIn');
            $table->string('facebook', 100)->nullable()
                ->comment('URL completa del perfil de Facebook');
            // LLAVE FORANEA
            
            //1ra forma
            /*$table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            */
            //2da forma (para usar las convenciones de Laravel)
            $table->foreignId('user_id')->constrained()
                ->onDelete('cascade')
                ->comment('ID del usuario al que pertenece este perfil');
            
            $table->timestamps();
        });

        // Agregar check constraints a nivel de base de datos
        DB::statement('ALTER TABLE profiles 
            ADD CONSTRAINT check_profession_length 
            CHECK (profession IS NULL OR LENGTH(profession) >= 3)');
        
        DB::statement('ALTER TABLE profiles 
            ADD CONSTRAINT check_about_length 
            CHECK (about IS NULL OR LENGTH(about) >= 10)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
