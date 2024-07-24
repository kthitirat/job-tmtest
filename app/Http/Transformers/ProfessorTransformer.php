<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Subject;
use App\Models\Department;
use App\Models\Professor;

class ProfessorTransformer extends TransformerAbstract
{
    public function transform(Professor $professor): array
    {
        $data = [
            'id' => $professor->id,
            'department' => fractal($professor->department, new DepartmentTransformer())->toArray(),
            'prefix' => $professor->prefix,
            'first_name' => $professor->first_name,
            'last_name' => $professor->last_name,
        ];
        return $data;
    }
}
