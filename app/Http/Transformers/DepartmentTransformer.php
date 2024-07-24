<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Subject;
use App\Models\Department;
use App\Http\Transformers\ProfessorTransformer;

class DepartmentTransformer extends TransformerAbstract
{
    public function transform(Department $department): array
    {
        $data = [
            'id' => $department->id,
            'name' => $department->name,
        
        ];
        return $data;
    }
}
