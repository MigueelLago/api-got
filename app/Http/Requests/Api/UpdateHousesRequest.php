<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHousesRequest extends FormRequest
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
     * @return array<string, mixed>
     */

    public function rules(){
        return [
            
            'name' => 'string|required',
            'region' => 'string|required',
            'founded_in' => 'string|required',
            'lord' => 'array|required',
            'lord.name' => 'string|required',
            'lord.seasons_appeared' => 'array|required',
            'lord.gender' => 'string|required',
            'lord.titles' => 'array',
            'lord.aliases' => 'array',
            'lord.interpretedBy' => 'string|required'
        ];
    }

    public function messages(){
        
        return [
            'name.required' => 'O campo name é obrigatório.',
            'region.required' => 'O campo region é obrigatório.',
            'founded_in.required' => 'O ano da fundação da casa é obrigatório.',
            'lord.required' => 'O campo Lord é obrigatório.',
            'lord.name.required' => 'O campo name do Lord é obrigatório.',
            'lord.seasons_appeared.required' => 'O campo seasons_appeared do Lord é obrigatório.',
            'lord.seasons_appeared.array' => 'O campo seasons_appeared do Lord deve ser um array.',
            'lord.seasons_appeared.*.required' => 'Cada temporada em seasons_appeared do Lord é obrigatória.',
            'lord.gender.required' => 'O gênero do Lord é obrigatório.',
            'lord.titles.array' => 'O campo titles do Lord deve ser um array.',
            'lord.aliases.array' => 'O campo aliases do Lord deve ser um array.',
            'lord.interpretedBy.required' => 'O campo interpretedBy do Lord é obrigatório.'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new \Illuminate\Validation\ValidationException(
            $validator,
            response()->json(['errors' => $validator->errors()], 422)
        );
    }
}
