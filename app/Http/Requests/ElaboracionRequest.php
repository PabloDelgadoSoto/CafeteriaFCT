<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ElaboracionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'bocadillo_id' => ['required', 'integer', 'min:1'],
            'ingrediente_id' => ['required', 'integer', 'min:1'],
            'cantidad' => ['required', 'min:0.01'],
        ];
    }
}
