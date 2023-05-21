<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvocatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nomprénom' => 'required|min:5|max:255',
            'telephone' => 'required|regex:/^\+?\d{1,3}[-.\s]?\(?\d{1,3}\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}$/'
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'nomprénom' => 'nom et prénom ',
            'telephone' => 'numéro de telephone'
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nomprénom' => 'nom et prénom sont requis ',
            'telephone' => 'numéro de telephone est requis'
        ];
    }
}