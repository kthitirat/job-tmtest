<?php

namespace App\Actions\Dashboard;

use App\Models\Subject;
use App\Models\Article;
use DOMDocument;
use Illuminate\Support\Str;

class SaveSubjectAction
{
    protected Subject $subject;

    public function execute(Subject $subject, array $data): Subject
    {
        
        $this->Subject = $subject;
        $this->Subject->code = $data['code'];
        $this->Subject->name_th = $data['name_th'];
        $this->Subject->name_en = $data['name_en'];
        $this->Subject->unit = $data['unit'];
        $this->Subject->published_at = $data['published_at'];
        $this->Subject->description = $data['description'];

        $this->Subject->save();

        dd('ok');



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

}
