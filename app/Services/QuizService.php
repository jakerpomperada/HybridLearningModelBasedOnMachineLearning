<?php

    namespace App\Services;

    use App\Models\StudentQuiz;
    use App\Models\StudentQuizAssessmentCategory;
    use App\Models\StudentQuizCategory;
    use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
    use Domain\Modules\Teacher\Entities\QuizAssessmentQuestion;

    class QuizService
    {

        protected AssessmentService $assessmentService;
        protected IAssessmentRepository $assessmentRepository;


        public function __construct(AssessmentService $assessmentService, IAssessmentRepository $assessmentRepository)
        {
            $this->assessmentService = $assessmentService;
            $this->assessmentRepository = $assessmentRepository;
        }


        public function SaveQuizScore($quiz_category_id, string $admission_id, string $teaching_load_id): void
        {
            $r = $this->assessmentService->QuizScore($quiz_category_id, $admission_id);

            $countQuizAssessment = StudentQuizAssessmentCategory::where([
                'teaching_load_id' => $teaching_load_id
            ])->count();

            $category = StudentQuizCategory::create([
                'date'             => now(),
                'teaching_load_id' => $teaching_load_id,
                'points'           => $countQuizAssessment,
                'title'            => $r->title,
            ]);

            StudentQuiz::create([
                'student_quiz_category_id' => $category->id,
                'student_admission_id'     => $admission_id,
                'score'                    => $r->score,
            ]);
        }

    }
