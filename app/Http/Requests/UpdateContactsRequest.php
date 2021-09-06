<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Contacts;
use Illuminate\Http\JsonResponse;
use Flash;
class UpdateContactsRequest extends FormRequest
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
    public function rules()
    {
        return [
            'email' => 'required|email:rfc,dns|max:45',
            'name' => 'required|string|max:255',
            'phone' => 'required|celular_com_ddd',
            'message' => 'required',
            'file' => 'required|mimes:doc,docx,pdf,odt,txt|max:500'
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'E-mail é obrigatório!',
            'email.email' => 'E-mail informado não é válido!',
            'name.required' => 'Nome é obrigatório!',
            'name.max' => 'Nome deve ter no maximo 255 caracteres!',
            'phone.required' => 'Campo telefone não é obrigatório!',
            'phone.celular_com_dd' => 'Telefone está no padrão incorreto! Favor utilizar (99)99999-9999',
            'message.required' => 'A mensagem é obrigatória!',
            'file.required' => 'O arquivo é obrigatório!',
            'file.mimes' => 'Extensão de arquivo não aceita!',
            'file.max' => 'O arquivo ultrapassa o tamanho máximo de 500kb!',
        ];
    }

}
