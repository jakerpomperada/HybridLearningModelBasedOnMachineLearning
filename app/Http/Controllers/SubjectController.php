<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Subject\Entities\Subject;
    use Domain\Modules\Subject\Repositories\ISubjectRepository;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\View\View;

    class SubjectController extends Controller
    {
        protected ISubjectRepository $subjectRepository;


        public function __construct(ISubjectRepository $subjectRepository)
        {
            $this->subjectRepository = $subjectRepository;
        }


        public function index(): View
        {

            return view('subject.index')->with([
                'subjects' => [],
                'paginate' => ""
            ]);
        }

        public function create(): View
        {
            return view('subject.create');
        }

        public function store(Request $req)
        {

            $val = Validator::make($req->all(), [
                'subject_code'        => 'required',
                'subject_description' => 'required'
            ]);

            if ($val->fails())  {
                return redirectWithErrors($val);
            }

            $subject = new Subject(
                $req->input('subject_code'),
                $req->input('subject_description')
            );

            $this->subjectRepository->Save($subject);

            return redirectWithAlert('/subject',[
               'alert-success' => 'New subject has been added!'
            ]);


        }


    }
