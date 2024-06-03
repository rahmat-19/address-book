<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            "status" => false,
            "message" => 'data does not match the rules',
            "errors" => $validator->errors()
        ], 422));
    }
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required',
            'active' => 'nullable',
            'category' => 'required',
            'address' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
        if ($this->routeIs('users.update')) {
            $id = $this->route('id');
            $rules['phone_number'] = ['required', 'min:3', 'max:13', 'starts_with:62',  Rule::unique('contacts')->ignore($id)];
        } else {
            $rules['phone_number'] = 'unique:contacts|required|min:3|max:13|starts_with:62';
        }
        return $rules;
    }
}
