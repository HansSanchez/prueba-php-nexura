<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'sex' => 'required',
            'area' => 'required',
            'roles' => 'required',
            'description' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => "El nombre del empleado es requerido.",
            'email.required' => "El correo electrónico del empleado es requerido.",
            'email.email' => "El correo electrónico no tiene un formato adecuado.",
            'sex.required' => "El sexo del empleado es requerido.",
            'area.required' => "El área a la que pertenece el empleado es requerida.",
            'roles.required' => "El rol del empleado es requerido.",
            'description.required' => "La aclaración del permiso es requerida.",
        ];
    }
}
