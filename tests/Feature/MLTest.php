<?php

    namespace Tests\Feature;

    use Phpml\Classification\SVC;
    use Phpml\Regression\LeastSquares;
    use Phpml\Regression\SVR;
    use Phpml\SupportVectorMachine\Kernel;
    use Tests\TestCase;

    class MLTest extends TestCase
    {
        /**
         * A basic feature test example.
         */
        public function testLinearRegression(): void
        {

            $number_of_quizzes = [[1], [2], [3], [4], [5]];
            $grades_per_quizzes = [70, 72, 85, 78, 80];

            $regression = new SVR(Kernel::LINEAR);
            $regression->train($number_of_quizzes, $grades_per_quizzes);

            $predictedGrades = [];
            for ($added_quizzes = 6; $added_quizzes <= 10; $added_quizzes++) { //predict 6 -> 10 quiz grades
                $predictedGrade = $regression->predict([$added_quizzes]);
                $predictedGrades[$added_quizzes] = $predictedGrade;
            }

            dd($predictedGrades);
        }
    }
