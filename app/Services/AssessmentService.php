<?php

    namespace App\Services;

    use Domain\Modules\Assessment\Repositories\IAssessmentRepository;

    class AssessmentService
    {
        protected IAssessmentRepository $assessmentRepository;


        public function __construct(IAssessmentRepository $assessmentRepository)
        {
            $this->assessmentRepository = $assessmentRepository;
        }


        public function QuizScore(string $qacategory_id, string $admission_id)
        {

            $result = $this->assessmentRepository->FindQuizAssessmentGetScoreByCategory(
                '33d6255e-5a4e-41c3-9fc8-658fc5bae7bf','29f57c3a-79a9-4219-8b42-ffe50289a871'
            );
           return (object) [
               'quiz_category_id' => $result->category_id,
               'title' => $result->title,
               'score' => $result->score ?? 0
           ];





        }

    }
