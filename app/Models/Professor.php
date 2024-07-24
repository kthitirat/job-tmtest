<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\department;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = ['department_id','prefix','first_name','last_name'];


    //สังกัดที่ไหน
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');   //belongsTo แบบหลายต่อหนึ่ง อาจารย์หนึ่งคนสังกัดแผนกเดียว
    }
}
