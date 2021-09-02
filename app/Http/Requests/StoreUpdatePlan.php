<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreUpdatePlan extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //coloquei para true
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        //criar execeção para eu poder enviar o mesmo nome do plano quando for atualizar algum plano

        //Pegando o segmento, ou seja, o campo url
        //http://127.0.0.1:8000/admin/plans/plano-normal
        // admin = segmento 1
        //plans = segmento 2
        //plano-normal 3       
        // é contado assim

        $url = $this->segment(3);

       

        //aqui eu crio as regras de validação
        return [
           'name' => "required|min:3|max:255|unique:plans,name,{$url},url",
           'description' => 'nullable|min:3|max:255',
           'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }
}
