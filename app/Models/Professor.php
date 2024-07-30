<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\department;
use App\Models\Subject;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Professor extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const MEDIA_COLLECTION_IMAGE = 'image';

    protected $fillable = ['department_id','prefix','first_name','last_name'];


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION_IMAGE)->singleFile()
             ->registerMediaConversions(function (Media $media) {
                $this
                    ->addMediaConversion('optimized')
                    ->fit(Manipulations::FIT_MAX, 560, 660)
                    ->optimize()
                    ->keepOriginalImageFormat();
            });
    }


    //สังกัดที่ไหน
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');   //belongsTo แบบหลายต่อหนึ่ง อาจารย์หนึ่งคนสังกัดแผนกเดียว
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);   //Professor สอนหลาย Subject
    }     


}
