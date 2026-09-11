<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user_id" => ['required', 'exists:user,id'],
            "department_id" => ['required', 'exists:departmen,id'],
            "profile_url" => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            "phone_no" => ['string', 'required'],
            'nrc_no' => ['string', 'required'],
            'address' => ['string', 'required'],
            'dob' => ['string', 'required'],
            'gender' => ['string', 'required'],
            'status' => ['string', 'required'],
            'hire_date' => ['date', 'required'],
            'position' => ['string', 'required'],
            'salary' => ['decimal', 'required'],
        ];
    }
}
