<?php

    namespace App\Http\Controllers;

    use App\Http\Resources\AcademicTermResource;
    use Domain\Modules\AcademicTerm\Entities\AcademicTerm;
    use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
    use Error;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\View\View;

    class AcademicTermController extends Controller
    {

        protected IAcademicTermRepository $academicTermRepository;


        public function __construct(IAcademicTermRepository $academicTermRepository)
        {
            $this->academicTermRepository = $academicTermRepository;
        }


        public function index(): View
        {

            $at = $this->academicTermRepository->GetAllPaginate(1,6);


            $terms = AcademicTermResource::collection($at->terms)->resolve();

            return view('academic-term.index')->with([
                'terms'    => $terms,
                'paginate' => $at->paginate
            ]);
        }

        public function create(): View
        {
            return view('academic-term.create');
        }

        public function store(Request $req)
        {
            try {
                $val = Validator::make($req->all(), [
                    'year_from' => 'required|int',
                    'year_to'   => 'required|int',
                ]);

                if ($val->fails()) {
                    throw new Error($val->getMessageBag()->all()[0]);
                }

                $academic_term = new AcademicTerm($req->input('year_from'), $req->input('year_to'));

                $this->academicTermRepository->Save($academic_term);

                return redirectWithAlert('/academic-term', [
                    'alert-success' => 'New Academic Term has been added!'
                ]);

            } catch (Error $error) {
                return redirectExceptionWithInput($error);
            }

        }


        public function show(string $id) : View {

            $data = $this->academicTermRepository->find($id);

            $term = (new AcademicTermResource($data))->resolve();

            return view('academic-term.edit')->with([
                'term' => (object) $term
            ]);
        }


        public function update(Request $req, string $id) {
            try {
                $val = Validator::make($req->all(), [
                    'year_from' => 'required|int',
                    'year_to'   => 'required|int',
                ]);

                if ($val->fails()) {
                    throw new Error($val->getMessageBag()->all()[0]);
                }

                $academic_term = new AcademicTerm(
                    $req->input('year_from'),
                    $req->input('year_to'),
                    $id
                );

                $this->academicTermRepository->Update($academic_term);

                return redirectWithAlert('/academic-term', [
                    'alert-info' => 'Academic Term has been updated!'
                ]);

            } catch (Error $error) {
                return redirectExceptionWithInput($error);
            }
        }

        public function destroy(string $id) {

            $this->academicTermRepository->Delete($id);

            Session::flash('alert-danger', 'Academic Term has been deleted');

            return response()->json([
                'success' => true
            ]);

        }


    }
