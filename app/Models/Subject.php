<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Builder;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_th',
        'name_en',
        'code',
        'description',
        'unit',
        'published_at',
        'view',
    ];

    protected $casts = [                                //ป้องกันการใส่ สคริป เข้ามา
        'published_at' => 'datetime',
        'view' => 'integer',
    ];

    public function professors()
    {
        return $this->belongsToMany(Professor::class);   //subject มีอาจารย์ได้หลายคน
    } 

    public function scopeFilter(Builder $query, array $filters): void
    {
        if (isset($filters['search']) && $filters['search'] != null) {
            $searchTerm = $filters['search'];
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name_th', 'LIKE', "%$searchTerm%")
                    ->orWhere('name_en', 'LIKE', "%$searchTerm%")
                    ->orWhere('code', 'LIKE', "%$searchTerm%");
            })->orWhereHas('professors',function ($query) use ($searchTerm) {
                $query->where('first_name', 'LIKE', "%$searchTerm%")
                    ->orWhere('last_name', 'LIKE', "%$searchTerm%");
            })->orWhereHas('professors.department', function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', "%$searchTerm%");
            });
       
         }

    }

}

