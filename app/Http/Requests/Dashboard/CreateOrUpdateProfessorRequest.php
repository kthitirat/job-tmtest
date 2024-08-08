<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateProfessorRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:102400'], // Maximum size 100MB,
            'prefix' => ['required', 'string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'department_id' => ['required', 'exists:departments,id']


            //ตัวอย่างของเดิม
            // 'type_id' => ['required', 'integer', 'exists:announcement_types,id'],
            // 'category_id' => ['required', 'integer', 'exists:announcement_categories,id'],
            // 'title' => ['required', 'string', 'max:255'],
            // 'position' => ['required', 'string', 'max:255'],
            // 'degree' => ['required', 'string', 'max:255'],
            // 'open_position' => ['required', 'integer', 'min:1'],
            // 'start_date' => ['required', 'date', 'date_format:Y-m-d'],
            // 'end_date' => ['nullable', 'date', 'date_format:Y-m-d', 'after:start_date'],
            // 'files.*' => ['file', 'mimes:pdf', 'max:10240'],
            // 'delete_medias' => ['nullable'],
            // 'delete_medias.*' => ['integer']
        ];
        if (request()->method == 'PATCH') {
            $rules['image'] = ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:102400'];
            //$rules['documents.*'] = ['nullable'];
        }

        return $rules;
    }
}
