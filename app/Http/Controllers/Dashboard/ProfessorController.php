<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Professor;
use App\Http\Transformers\ProfessorTransformer;
use Inertia\Inertia;

class ProfessorController extends Controller
{
    public function index()
    {       
        $professors = Professor::orderBy('created_at', 'desc')->paginate(10);
        $professorData = fractal($professors, new ProfessorTransformer())->includeImage()->toArray();      
        return Inertia::render('Dashboard/Professor/Index')->with([
            'professors' =>  $professorData
        ]);
    }

    public function create(Professor $professor)
    {
        dd($professor);
        // $professors = Professor::all();
        // $professorData = fractal($professors, new ProfessorTransformer())->includeImage()->toArray()['data'];
        // return Inertia::render('Dashboard/Subject/Create')->with([
        //     'professors' => $professorData
        // ]);
    }

    public function edit(Professor $professor)
    {
        dd($professor);
        // $professors = Professor::all();
        // $professorData = fractal($professors, new ProfessorTransformer())->includeImage()->toArray()['data'];
        // $subjectData = fractal($subject, new SubjectTransformer())->includeImage()->includeDocuments()->toArray();
        // return Inertia::render('Dashboard/Subject/Edit')->with([
        //     'professors' => $professorData,
        //     'subject'   => $subjectData
        // ]);
        
    }

    public function destroy(Professor $professor)
    {
        //หากมีอาจารย์สอนอยู่ลบไม่ได้
        if ($professor->subjects()->count() > 0) {
            return redirect()->route('dashboard.professors.index')->with('error','professor ยังมีสอนอยู่');
        }//เพิ่มคำสั่งมา

        $professor->delete();
        return redirect()->route('dashboard.professors.index')->with('success','professor deleted');      
    }
}
