<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Models\StudentExamAssessmentCategory;
	use App\Models\StudentQuizAssessmentCategory;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Request;
	
	class QuizAssessmentStatusController extends Controller
	{
		public function give($id): RedirectResponse
		{
			
			$loading_id = request()->input('teaching_load_id');
			
			StudentQuizAssessmentCategory::where(['id' => $id])->update([
				'status' => 'give'
			]);
			
			return redirectWithAlert('teacher/student-quiz-assessment?teaching_load_id=' . $loading_id . '', [
				'alert-success' => 'Quiz Assessment has been given!'
			]);
			
			
		}
		
		
		public function ungive($id): RedirectResponse
		{
			
			$loading_id = request()->input('teaching_load_id');
		
			StudentQuizAssessmentCategory::where(['id' => $id])->update([
				'status' => 'ungive'
			]);
			
			return redirectWithAlert('teacher/student-quiz-assessment?teaching_load_id=' . $loading_id . '', [
				'alert-warning' => 'Quiz Assessment has been ungive!'
			]);
		}
	}
