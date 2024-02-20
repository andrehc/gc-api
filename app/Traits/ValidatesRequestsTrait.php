<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait ValidatesRequestsTrait
{
    /**
     * Valida os dados usando o Validator.
     *
     * @param array $data
     * @param array $rules
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validateData(array $data, array $rules)
    {
        return Validator::make($data, $rules);
    }

    /**
     * Responde com erro de validação.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithValidationErrors($validator)
    {
        return response()->json([
            'message' => 'Erro de validação', 'errors' => $validator->errors()
        ], 422);
    }
}
