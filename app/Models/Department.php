<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\professor;

class Department extends Model
{
    use HasFactory;  
    protected $fillable = ['name'];     //ข้อมูลอะไร Save ลงดาต้าเบสได้


    public function professors()
    {
        return $this->hasMany(professor::class, 'department_id');  //hasMany แบบหนึ่งต่อหลาย แผนกหนึ่งสามารถมีอาจารย์ได้หลายคน
    }
    
}
