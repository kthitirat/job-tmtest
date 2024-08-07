<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateSubjectRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'code' => ['nullable'],
            'name_th' => ['required'],
            'name_en' => ['nullable'],
            'unit' => ['nullable'],
            'published_at' => ['nullable', 'date'],
            'description' => ['nullable'],
            'professors' => ['nullable', 'array', 'min:1'],
            'professors.*.id' => ['nullable','exists:professors,id'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:102400'], // Maximum size 100MB
            'documents' => ['required', 'array', 'min:1'],
            'documents.*' => ['required', 'mimes:pdf,ppt,pptx,doc,docx,xls,xlsx', 'max:102400'], // Maximum size 100MB
            'to_delete_documents.*' => ['nullable']


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
            $rules['documents.*'] = ['nullable'];
        }

        return $rules;
    }
}
