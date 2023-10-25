<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'imageInput' => 'image',
            'lastName' => ['required','string', 'max:255'],
            'firstName' => ['required','string', 'max:255'],
            'birthday' => ['required','string', 'max:255'],
            'gender' => ['required','string', 'max:255'],
            'email' => ['required', 'string', 'email', Rule::unique('users', 'email')->ignore(auth()->id(), 'userID')],
        ];
    }
}
