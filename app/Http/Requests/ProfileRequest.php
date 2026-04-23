<?php

namespace App\Http\Requests;

//use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    // Autorizar los permisos del request
    public function authorize(): bool
    {
        return true;
    }

    // Creando las reglas de validacion
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'profession' => 'nullable|string|max:60|min:3',
            'about' => 'nullable|string|max:255|min:10',
            'twitter' => 'nullable|string|max:100|regex:/^@?[A-Za-z0-9_]{1,15}$/', 
            'linkedin' => 'nullable|string|max:100|regex:/^https?:\/\/(www\.)?linkedin\.com\/in\/[A-Za-z0-9\-_]+$/',
            'facebook' => 'nullable|string|max:100|regex:/^https?:\/\/(www\.)?facebook\.com\/[A-Za-z0-9\.]+$/',
        ];
    }

    // Mensajes personalizados
    public function messages(): array
    {
        return [
            'twitter.regex' => 'El usuario de Twitter debe ser válido (ejemplo: @usuario)',
            'linkedin.regex' => 'La URL de LinkedIn debe ser válida',
            'facebook.regex' => 'La URL de Facebook debe ser válida',
            'photo.max' => 'La foto no debe pesar más de 2MB',
            'about.min' => 'La descripción debe tener al menos 10 caracteres',
        ];
    }
}
