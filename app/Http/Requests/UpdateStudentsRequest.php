<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentsRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'txtfullname' => 'required',
            'txtgender' => 'required',
            'txtemail' => [
                'required',
                Rule::unique('students','emailaddress')->ignore($this->txtid,'idstudents'),
            ],
            'txtphone' => 'required|numeric',
            'txtaddress' => 'required',

        ];
    }

    public function messages(): array{
        return[
            'txtfullname.required'=>':attribute Tidak Boleh Kosong',
            'txtgender.required' => ':attribute Tidak Boleh Kosong',
            'txtaddress.required' => ':attribute Tidak Boleh Kosong',
            'txtemail.required' => ':attribute Tidak Boleh Kosong',
            'txtphone.required' => ':attribute Tidak Boleh Kosong',
        ];
    }

    public function attributes(): array{
        return[
            'txtfullname' => 'Nama Lengkap',
            'txtgender' =>'Gender',
            'txtemail' =>'alamat email',
            'txtaddress' =>'alamat',
            'txtphone' => 'no telepon'
        ];
    }
}
