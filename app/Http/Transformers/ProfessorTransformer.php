<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Subject;
use App\Models\Department;
use App\Models\Professor;
use App\Http\Transformers\ImageTransformer;

class ProfessorTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['image'];

    public function transform(Professor $professor): array
    {
        $data = [
            'id' => $professor->id,
            'department' => fractal($professor->department, new DepartmentTransformer())->toArray(),
            'prefix' => $professor->prefix,
            'first_name' => $professor->first_name,
            'last_name' => $professor->last_name,
            'fullname' => $professor->prefix. ' ' .$professor->first_name. ' ' .$professor->last_name,
        ];
        return $data;
    }

    public function includeImage(Professor $professor)
    {
        $images = $professor->getMedia(Professor::MEDIA_COLLECTION_IMAGE);   
        return $this->collection($images, new ImageTransformer());
    }

}
