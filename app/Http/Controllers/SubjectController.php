<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use Inertia\Inertia;
use App\Http\Transformers\SubjectTransformer;
use Illuminate\Support\Facades\Session;

class SubjectController extends Controller
{
    public function index()
    {
        return redirect()->route('index');
    }

    //public function show(Subject $subject)
    public function show(string $subject)       //เพิ่ม uuid (ลิงก์ที่ไม่โชว์ id จริง)
    {
        $subject = Subject::where('uuid', $subject)->first();  //เพิ่ม uuid (ลิงก์ที่ไม่โชว์ id จริง)

        if($subject->published_at === null) {
            abort(403, 'unauthorized.');
        }
        //$subjectData = fractal($subject, new SubjectTransformer())->toArray();

        //การเพิ่มยอด view
        $userIp = (string)request()->ip();
        $transformUserIP = str_replace('.', '_', $userIp);
        if (!$this->checkSessionByIp($transformUserIP, $subject->id)) {
            $subject->increment('view');
        }
        Session::put($transformUserIP, $subject->id); 
        $subject->fresh();
        $subjectData = fractal($subject, new SubjectTransformer())->includeImage()->includeDocuments()->toArray();
        //จบเพิ่มยอด view

        return Inertia::render('Subject/Show')->with([
            'subject' => $subjectData
          
        ]);
    }

    //การเพิ่มยอด view
    public function checkSessionByIp($transformUserIP, $subjectId)
    {       
        if(Session::get($transformUserIP) === $subjectId) {
            return true;
        }
        return false;
    }


}
