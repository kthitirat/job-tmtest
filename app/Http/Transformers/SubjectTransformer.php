<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Subject;
use App\Http\Transformers\ProfessorTransformer;
use App\Http\Transformers\ImageTransformer;
use App\Http\Transformers\DocumentTransformer;
use Carbon\Carbon;

class SubjectTransformer extends TransformerAbstract
{
    protected array $availableIncludes = ['image','documents'];   //เพิ่ม pdf โดยใส่ 'documents'

    public function transform(Subject $subject): array
    {
        $data = [
            //'id' => $subject->id,           
            'id' => $subject->uuid,      //เพิ่ม uuid (ลิงก์ที่ไม่โชว์ id จริง)
            'uuid' => $subject->uuid,    //เพิ่ม uuid (ลิงก์ที่ไม่โชว์ id จริง)
            'name_th' => $subject->name_th,
            'name_en' => $subject->name_en,
            'code' => $subject->code,
            'view' => $subject->view,
            'description' => $subject->description,
            'professors' => fractal($subject->professors, new ProfessorTransformer())->includeImage()->toArray()['data'],
            'published_at' => $subject->published_at ? Carbon::parse($subject->published_at)->thaidate('j M Y') : null,
           
        ];
        return $data;
    }
    
    public function includeImage(Subject $subject)
    {
        $images = $subject->getMedia(Subject::MEDIA_COLLECTION_IMAGE);   
        return $this->collection($images, new ImageTransformer());
    }

    public function includeDocuments(Subject $subject)                      //เพิ่ม pdf
    {
        $documents = $subject->getMedia(Subject::MEDIA_COLLECTION_DOCUMENTS);   
        return $this->collection($documents, new DocumentTransformer());
    }


}
