<?php

    namespace App\Http\Controllers\Student;

    use App\Http\Controllers\Controller;
    use App\Models\Admission;
    use App\Models\StudentQuizAssessmentAnswer;
    use App\Models\StudentQuizAssessmentCategory;
    use App\Models\StudentQuizAssessmentQuestion;
    use App\Models\StudentQuizAssessmentStatus;
    use App\Models\StudentQuizCategory;
    use App\Models\TeachingLoad;
    use App\Services\AssessmentService;
    use App\Services\QuizService;
    use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
    use Domain\Modules\Student\Repositories\IStudentRepository;
    use Domain\Modules\Teacher\Entities\QuizAssessmentChoice;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    class TakeQuizController extends Controller
    {

        protected IStudentRepository $studentRepository;
        protected AssessmentService $assessmentService;
        protected QuizService $quizService;


        public function __construct(IStudentRepository $studentRepository, AssessmentService $assessmentService, QuizService $quizService)
        {
            $this->studentRepository = $studentRepository;
            $this->assessmentService = $assessmentService;
            $this->quizService = $quizService;
        }


        public function show($quiz_cat_id)
        {
            $num = request()->input('num');

            $category = StudentQuizAssessmentCategory::find($quiz_cat_id);


            $question_data = StudentQuizAssessmentQuestion::with([
                'StudentQuizAssessmentChoice'
            ])->where([
                'qacategory_id' => $quiz_cat_id
            ])->get()[$num];


            $questions = (object)[
                'id'       => $question_data->id,
                'question' => $question_data->question,
                'choices'  => collect($question_data->StudentQuizAssessmentChoice)->map(function ($i, $num) {

                    return (object)[
                        'id'     => $i->id,
                        'order'  => $i->order,
                        'letter' => display_letter($num),
                        'choice' => $i->choice,

                    ];
                })
            ];


            return view('student.take-quiz.index')->with([
                'choices'          => QuizAssessmentChoice::choices(),
                'question'         => $questions,
                'num'              => $num,
                'quiz_category_id' => $quiz_cat_id,
                'teaching_load_id' => $category->teaching_load_id
            ]);
        }

        public function SaveNextQuiz(Request $req)
        {
            $teaching_load_id = request()->input('teaching_load_id');
            $quiz_category_id = request()->input('quiz_category_id');
            $ans = request()->input('answer');
            $num = request()->input('current_num');
            $question_id = request()->input('question_id');


            $teaching_load = TeachingLoad::with(['Course'])->where('id', $teaching_load_id)->first();

            $student = $this->studentRepository->FindByUserId(Auth::id());

            $admission = Admission::where([
                'academic_term_semester_id' => $teaching_load->academic_term_semester_id,
                'student_id'                => $student->id,
                'course_id'                 => $teaching_load->Course->id,
                'year_level'                => $teaching_load->year_level,
            ])->first();


            $count = StudentQuizAssessmentQuestion::with([
                'StudentQuizAssessmentChoice'
            ])->where([
                'qacategory_id' => $quiz_category_id
            ])->count();


            StudentQuizAssessmentAnswer::where([
                'quiz_assessment_question_id' => $question_id,
                'admission_id'                => $admission->id,
            ])->delete();


            StudentQuizAssessmentAnswer::create([
                'quiz_assessment_question_id' => $question_id,
                'quiz_assessment_choice_id'   => $ans,
                'admission_id'                => $admission->id,
            ]);


            $num = $num + 1;

            if ($count == $num) {
                $data = [
                    'sqac_id'    => $quiz_category_id,
                    'student_id' => $student->id,
                ];

                $this->quizService->SaveQuizScore(
                    $quiz_category_id, $admission->id, $teaching_load_id
                );











                StudentQuizAssessmentStatus::updateOrCreate($data, $data);


                return redirectWithAlert('/student/assessment?teaching_load_id=' . $teaching_load_id, [
                    'alert-success' => 'Quiz Assessment has been answered'
                ]);
            }
            return redirect('student/take-quiz/' . $quiz_category_id . '?num=' . $num);


        }
    }
