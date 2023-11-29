<?php

    namespace App\Http\Controllers;

    use App\Http\Resources\StudentResource;
    use Domain\Modules\Student\Repositories\IStudentRepository;

    class SocioEconomicReportController extends Controller
    {

        protected IStudentRepository $studentRepository;


        public function __construct(IStudentRepository $studentRepository)
        {
            $this->studentRepository = $studentRepository;
        }


        public function index()
        {

            return view('admin.reports.socio-economic')->with([
                'module' => request()->input('module') ?? 'teacher'
            ]);
        }


        public function printMobilePhones()
        {

            $students_data = $this->studentRepository->GetAll();

            $students_data_aggregates = collect($students_data)->map(function ($stud) {
                return $this->studentRepository->Aggregates($stud);
            });

            $has_internet = 0;
            $no_internet = 0;
            $r = [];
            foreach ($students_data_aggregates as $st) {
                if (!$st->isHasInternetConnectivity()) {
                    $no_internet += 1;
                } else {
                    $has_internet += 1;
                }

            }

            $students = StudentResource::collection($students_data_aggregates)->resolve();

            return view('admin.reports.mobile-phone')->with([
                'students'     => $students,
                'has_internet' => $has_internet,
                'no_internet'  => $no_internet,

            ]);
        }
    }
