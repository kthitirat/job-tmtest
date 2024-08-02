<?php

namespace App\Actions\Dashboard;

use App\Models\Subject;
use App\Models\Article;
use DOMDocument;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class SaveSubjectAction
{
    protected Subject $subject;

    public function execute(Subject $subject, array $data)
    {
        $this->subject = $subject;
        $this->subject->code = $data['code'];
        $this->subject->name_th = $data['name_th'];
        $this->subject->name_en = $data['name_en'];
        $this->subject->unit = $data['unit'];
        $this->subject->published_at = $data['published_at'];
        $this->subject->description = $data['description'];
        $this->subject->save();

        $this->subject = $this->subject->fresh();
        $this->handleAssignProfessors($data['professors']);          //อัปโหลดอาจารย์
        $this->uploadSubjectImage($data['image']);                   //อัปโหลดภาพอาจารย์
        $this->uploadSubjectDocuments($data['documents']);

        return $this->subject;

       
        //ของเดิม
        // $this->announcement = $announcement;
        // $this->announcement->type_id = $data['type_id'];
        // $this->announcement->category_id = $data['category_id'];
        // $this->announcement->title = $data['title'];
        // $this->announcement->position = $data['position'];
        // $this->announcement->degree = $data['degree'];
        // $this->announcement->open_position = $data['open_position'];
        // $this->announcement->start_date = $data['start_date'];
        // $this->announcement->end_date = $data['end_date'];
        // $this->announcement->save();

        // if (isset($data['files'])) {
        //     $this->handleFileUpload($data['files']);
        // }
        // if (isset($data['delete_medias'])) {
        //     $this->handleDeleteMedias($data['delete_medias']);
        // }
        // return $this->announcement->fresh();
    }

    // private function handleFileUpload(array $files): void
    // {
    //     foreach ($files as $file) {
    //         $this->announcement->addMedia($file)->toMediaCollection(Announcement::MEDIA_COLLECTION_DOCUMENTS);
    //     }
    // }

    // private function handleDeleteMedias(array $mediaIds): int
    // {
    //     $medias = $this->announcement->media()->whereIn('id', $mediaIds)->get();
    //     $count = 0;
    //     if (count($medias) == 0) {
    //         return 0;
    //     }
    //     foreach ($medias as $media) {
    //         $media->delete();
    //         $count++;
    //     }
    //     return $count;
    // }

    //สร้างฟังชันก์  handleAssignProfessors  อัปโหลดอาจารย์
    private function handleAssignProfessors($professors): void
    {
        $professorCollection = collect($professors);
        $professorIds = $professorCollection->pluck('id')->toArray();
        $this->subject->professors()->sync($professorIds);
    }

    //อัปโหลดภาพอาจารย์
    private function uploadSubjectImage($image): void
    {
        if ($image == null) {
            return;
        }
        $this->subject->addMedia($image)->toMediaCollection(Subject::MEDIA_COLLECTION_IMAGE);
    }

    private function uploadSubjectDocuments($documents): void
    {
        foreach ($documents as $document) {
            if ($documents instanceof UploadedFile) {
                $this->subject->addMedia($document)->toMediaCollection(Subject::MEDIA_COLLECTION_DOCUMENTS);
            }
        }
    }

}
