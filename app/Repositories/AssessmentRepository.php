<?php

    namespace App\Repositories;

    use App\Models\StudentExamAssessmentCategory;
    use App\Models\StudentExamAssessmentQuestion;
    use App\Models\StudentExamCategory;
    use App\Models\StudentQuizAssessmentCategory;
    use App\Models\StudentQuizAssessmentChoice;
    use App\Models\StudentQuizAssessmentQuestion;
    use Domain\Modules\Assessment\Entities\ExamAssessmentCategory;
    use Domain\Modules\Assessment\Repositories\IAssessmentRepository;
    use Domain\Modules\Teacher\Entities\ExamAssessmentQuestion;
    use Domain\Modules\Teacher\Entities\QuizAssessmentChoice;
    use Domain\Modules\Teacher\Entities\QuizAssessmentQuestion;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\DB;

    class AssessmentRepository extends Repository implements IAssessmentRepository
    {


        public function GetAllQuizByCategoryPaginate(string $cat_id, int $page): Paginator
        {
            return StudentQuizAssessmentQuestion::with(['StudentQuizAssessmentChoice'])->where([
                'qacategory_id' => $cat_id,
            ])->paginate($page);
        }

        public function GetAllExamByCategoryPaginate(string $cat_id, int $page): Paginator
        {
            return StudentExamAssessmentQuestion::with(['StudentExamAssessmentChoice'])->where([
                'eacategory_id' => $cat_id,
            ])->paginate($page);
        }


        public function SaveQuizAssessmentQuestions(QuizAssessmentQuestion $assessmentQuestion, string $sqaquestion_id): void
        {
            $id = uuid();

            DB::table('student_quiz_assessment_questions')->insert([
                'id'            => $id,
                'qacategory_id' => $sqaquestion_id,
                'question'      => $assessmentQuestion->getQuestion(),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);

            foreach ($assessmentQuestion->getChoices() as $choice) {
                /**
                 * @var QuizAssessmentChoice $choice
                 */
                DB::table('student_quiz_assessment_choices')->insert([
                    'id'             => uuid(),
                    'sqaquestion_id' => $id,
                    'order'          => $choice->getOrder(),
                    'choice'         => $choice->getChoice(),
                    'is_correct'     => $choice->isCorrect(),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);

            }

        }


        public function SaveExamAssessmentQuestions(ExamAssessmentQuestion $assessmentQuestion, string $eacategory_id): void
        {
            $id = uuid();

            DB::table('student_exam_assessment_questions')->insert([
                'id'            => $id,
                'eacategory_id' => $eacategory_id,
                'question'      => $assessmentQuestion->getQuestion(),
                'created_at'    => now(),
                'updated_at'    => now()
            ]);

            foreach ($assessmentQuestion->getChoices() as $choice) {
                /**
                 * @var QuizAssessmentChoice $choice
                 */
                DB::table('student_exam_assessment_choices')->insert([
                    'id'             => uuid(),
                    'seaquestion_id' => $id,
                    'order'          => $choice->getOrder(),
                    'choice'         => $choice->getChoice(),
                    'is_correct'     => $choice->isCorrect(),
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);

            }

        }

        public function FindQuizAssessmentQuestions(string $id): object|null
        {
            return StudentQuizAssessmentQuestion::with(['StudentQuizAssessmentChoice'])->where([
                'id' => $id,
            ])->first();
        }

        public function FindQuizCategory(string $id): object|null
        {
            return StudentQuizAssessmentCategory::find($id);
        }

        public function UpdateQuizAssessmentQuestions(QuizAssessmentQuestion $assessmentQuestion, string $quiz_assessment_question_id): void
        {

            DB::table('student_quiz_assessment_questions')->where(['id' => $quiz_assessment_question_id])->update([
                'question' => $assessmentQuestion->getQuestion(),
            ]);

            foreach ($assessmentQuestion->getChoices() as $choice) {
                /**
                 * @var QuizAssessmentChoice $choice
                 */
                DB::table('student_quiz_assessment_choices')->where(
                    [
                        'sqaquestion_id' => $quiz_assessment_question_id,
                        'order'          => $choice->getOrder()
                    ]
                )->update([
                    'order'      => $choice->getOrder(),
                    'choice'     => $choice->getChoice(),
                    'is_correct' => $choice->isCorrect(),
                ]);

            }
        }

        public function UpdateExamAssessmentQuestions(ExamAssessmentQuestion $assessmentQuestion, string $exam_assessment_question_id): void
        {

            DB::table('student_exam_assessment_questions')->where(['id' => $exam_assessment_question_id])->update([
                'question' => $assessmentQuestion->getQuestion(),
            ]);

            foreach ($assessmentQuestion->getChoices() as $choice) {
                /**
                 * @var QuizAssessmentChoice $choice
                 */
                DB::table('student_exam_assessment_choices')->where(
                    [
                        'seaquestion_id' => $exam_assessment_question_id,
                        'order'          => $choice->getOrder()
                    ]
                )->update([
                    'order'      => $choice->getOrder(),
                    'choice'     => $choice->getChoice(),
                    'is_correct' => $choice->isCorrect(),
                ]);

            }
        }


        public function SaveExamAssessmentCategory(ExamAssessmentCategory $assessment, string $teaching_load_id): void
        {
            DB::table('student_exam_assessment_categories')->insert([
                'id'               => uuid(),
                'start_date'       => $assessment->getDateStart(),
                'end_date'         => $assessment->getDateEnd(),
                'teaching_load_id' => $teaching_load_id,
                'term'             => $assessment->getTerm(),
                'status'           => $assessment->getStatus(),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }

        public function GetExamAssessmentCategory(string $teaching_load_id, int $page): Paginator
        {
            return StudentExamAssessmentCategory::paginate($page);
        }

        public function GetQuizAssessmentCategory(string $teaching_load_id, int $page): Paginator
        {
            return StudentQuizAssessmentCategory::with([
                'StudentQuizAssessmentQuestion'
            ])->where([
                'teaching_load_id' => $teaching_load_id,
                'status'           => 'give'
            ])->paginate($page);
        }

        public function FindExamAssessmentCategory(string $id): object|null
        {
            return StudentExamAssessmentCategory::find($id);
        }

        public function FindExamAssessmentQuestion(string $id): object|null
        {
            return StudentExamAssessmentQuestion::find($id);
        }

        public function GetQuizAssessmentCategoryAllWithRelation(array $relations, string $teaching_load_id): Collection|array
        {
            return StudentQuizAssessmentCategory::with($relations)->where([
                'teaching_load_id' => $teaching_load_id
            ])->get();
        }

        public function GetQuizQuestionsAllWithRelation(array $relations, string $qacategory_id): Collection|array
        {
            return StudentQuizAssessmentQuestion::with($relations)->with([
                'qacategory_id' => $qacategory_id
            ])->get();
        }

        public function GetAllQuizAssessmentByCategoryScores(string $quiz_category_id, string $admission_id): array
        {
            return [];
        }

        public function FindQuizAssessmentGetScoreByCategory(string $quiz_category_id, string $admission_id): object
        {
            $sql = "SELECT sqac.id as category_id, ";
            $sql .= "sqac.title, ";
            $sql .= "(SELECT SUM((SELECT (SELECT sqac.is_correct ";
            $sql .= "from student_quiz_assessment_choices sqac ";
            $sql .= "WHERE sqac.is_correct = true ";
            $sql .= "AND sqac.id = qaa.quiz_assessment_choice_id) is_correct ";
            $sql .= "FROM quiz_assessment_answers qaa ";
            $sql .= "WHERE qaa.quiz_assessment_question_id = sqaq.id ";
            $sql .= "AND qaa.admission_id = '".$admission_id."' LIMIT 1 )) as total_correct ";
            $sql .= "FROM student_quiz_assessment_questions sqaq ";
            $sql .= "WHERE sqaq.qacategory_id = sqac.id) as score ";
            $sql .= "FROM student_quiz_assessment_categories as sqac ";
            $sql .= "WHERE sqac.id = '".$quiz_category_id."'" ;
            return $this->find_query($sql);
        }
    }
