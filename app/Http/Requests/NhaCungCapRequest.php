<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhaCungCapRequest extends FormRequest
{
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
        return [
            'tennhacungcap' => ['required', 'string', 'max:191', 'unique:nhacungcap'],
            'tenviettat' => ['nullable', 'string', 'max:191'],
            'masothue' => ['required', 'numeric'],
            'sodienthoai' => ['nullable', 'numeric', 'digits_between:10,11'],
            'diachi' => ['nullable', 'string', 'max:191']
        ];
    }
}
