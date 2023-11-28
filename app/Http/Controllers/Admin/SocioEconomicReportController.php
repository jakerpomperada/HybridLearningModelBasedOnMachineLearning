<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Resources\StudentResource;
    use App\Models\Student;
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
            return view('admin.reports.socio-economic');
        }


        public function printMobilePhones()
        {

            $students_data = $this->studentRepository->GetAll();

            $students_data_aggregates = collect($students_data)->map(function ($stud) {
                return $this->studentRepository->Aggregates($stud);
            });

            $students = StudentResource::collection($students_data_aggregates)->resolve();

            return view('admin.reports.mobile-phone')->with([
                'students' => $students
            ]);
        }
    }
