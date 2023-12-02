<?php

    namespace App\Http\Controllers;

    use App\Services\BaseDataDropDownService;
    use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
    use Domain\Modules\Teacher\Repositories\ITeacherRepository;
    use Error;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\View\View;

    class TeachingLoadController extends Controller
    {
        protected BaseDataDropDownService $baseDataDropDownService;
        protected ITeacherRepository $teacherRepository;

        protected IAcademicTermRepository $academicTermRepository;

        public function __construct(BaseDataDropDownService $baseDataDropDownService, ITeacherRepository $teacherRepository, IAcademicTermRepository $academicTermRepository)
        {
            $this->baseDataDropDownService = $baseDataDropDownService;
            $this->teacherRepository = $teacherRepository;
            $this->academicTermRepository = $academicTermRepository;
        }


        public function index(): View
        {
            $data = $this->teacherRepository->GetAllTeachingLoadPaginate(request()->input('page') ?? 1, 5);

            $teaching_loads = collect($data->items())->map(function ($i) {
                return (object)[
                    'id'                  => $i->id,
                    'teacher'             => $i->getTeacherCompleteName(),
                    'subject_code'        => $i->getSubjectCode(),
                    'subject_description' => $i->getSubjectDescription(),
                    'semester'            => $i->getSemester(),
                    'course'              => $i->getCourse(),
                    'year_level'          => $i->getYearLevel(),
                    'term'                => $i->AcademicTermSemester->getTerm()
                ];
            });

            return view('admin.teaching-load.index')->with([
                'teaching_loads' => $teaching_loads,
                'paginate'       => $data->links()
            ]);

        }

        public function create(): View
        {
            $data = $this->baseDataDropDownService->getBaseData();


            $teachers = $this->teacherRepository->GetAll();

            $teachers = $teachers->mapWithKeys(function ($item, $key) {
                return [$item->id => $item->completeName()];
            });

            return view('admin.teaching-load.create')->with([
                'teachers'   => $teachers,
                'subjects'   => $data->subjects,
                'terms'      => $data->terms,
                'semesters'  => $data->semesters,
                'courses'    => $data->courses,
                'year_level' => $data->year_level,
                'sections'   => $data->sections
            ]);
        }

        public function store(Request $req): RedirectResponse
        {

            try {

                $val = Validator::make($req->all(), [
                    'teacher'    => 'required',
                    'subject'    => 'required',
                    'year_level' => 'required',
                    'section'    => 'required',
                    'semester'   => 'required',
                    'course'     => 'required',
                ]);

                if ($val->fails()) {
                    throw new Error($val->getMessageBag()->all()[0]);
                }


                $default_semester = $this->academicTermRepository->GetCurrentAcademicTerm();


                $this->teacherRepository->SaveTeachingLoad(
                    $req->teacher,
                    $req->subject,
                    $req->year_level,
                    $req->section,
                    $req->semester,
                    $req->course,
                    $default_semester->id
                );

                return redirectWithAlert('/teaching-load', [
                    'alert-success' => 'New teaching load has been added!'
                ]);

            } catch (Error $error) {
                return redirectExceptionWithInput($error);
            }


        }

        public function show($id)
        {

            $teaching_load = $this->teacherRepository->FindTeachingLoad($id);

            $data = $this->baseDataDropDownService->getBaseData();

            $teachers = $this->teacherRepository->GetAll();

            $teachers = $teachers->mapWithKeys(function ($item, $key) {
                return [$item->id => $item->completeName()];
            });

            return view('admin.teaching-load.edit')->with([
                'tl'         => $teaching_load,
                'term_id'    => $teaching_load->AcademicTermSemester->academic_id,
                'teachers'   => $teachers,
                'subjects'   => $data->subjects,
                'terms'      => $data->terms,
                'semesters'  => $data->semesters,
                'courses'    => $data->courses,
                'year_level' => $data->year_level,
                'sections'   => $data->sections
            ]);
        }

        public function update(Request $req, string $id): RedirectResponse
        {
            try {
                $val = Validator::make($req->all(), [
                    'teacher'    => 'required',
                    'subject'    => 'required',
                    'year_level' => 'required',
                    'section'    => 'required',
                    'semester'   => 'required',
                    'course'     => 'required',
                    'term'       => 'required'
                ]);

                if ($val->fails()) {
                    throw new Error($val->getMessageBag()->all()[0]);
                }

                $teaching_load = $this->teacherRepository->FindTeachingLoad($id);

                $term = $this->academicTermRepository->FindTermByTermIdSemester(
                    $req->input('term'), $req->input('semester')
                );

                $this->teacherRepository->UpdateTeachingLoad(
                    $term->term_semester_id,
                    $req->teacher,
                    $req->subject,
                    $req->year_level,
                    $req->section,
                    $req->semester,
                    $req->course,
                    $teaching_load->id
                );

                return redirectWithAlert('/teaching-load', [
                    'alert-info' => 'Teaching load has been updated!'
                ]);

            } catch (Error $error) {
                return redirectExceptionWithInput($error);
            }


        }


        public function destroy(string $id)
        {

            $this->teacherRepository->DeleteTeachingLoad($id);

            Session::flash('alert-danger', 'Teaching Load has been deleted');

            return response()->json([
                'success' => true
            ]);
        }


    }
