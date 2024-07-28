<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Inertia\Inertia;
use App\Http\Transformers\SubjectTransformer;

class SubjectController extends Controller
{
    public function index()
    {
        return redirect()->route('index');
    }

    public function show(Subject $subject)
    {
        if($subject->published_at === null) {
            abort(403, 'unauthorized.');
        }
        $subjectData = fractal($subject, new SubjectTransformer())->toArray();
        return Inertia::render('Subject/Show')->with([
            'subject' => $subjectData
          
        ]);
    }


}
