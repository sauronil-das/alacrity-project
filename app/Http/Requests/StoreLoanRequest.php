<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *amount: 0,
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'email' => [
                'email',
                'required',
                'unique:users'
            ],
            'name' => [
                'required',
            ],
            'password' => [
                'required',
                'min:8',
                'max:25'
            ],
            'phone' => [
                'required',
                'min:7',
                'max:20'
            ],
            'brp' => [
                'required',
                'size:11'
            ],
            'passport_number' => [
                'required',
                'min:10',
                'max:25'
            ],
            'sort_code' => [
                'required',
                'size:8'
            ],
            'bank_account' => [
                'required',
                'min:6',
                'max:25'
            ],
            'amount' => [
                'required',
                'integer'
            ]
        ];
    }
}
