<?php
	
	namespace App\Http\Controllers\Teacher;
	
	use App\Http\Controllers\Controller;
	use App\Models\StudentExamAssessment;
	use App\Models\StudentExamAssessmentCategory;
	use App\Models\StudentExamCategory;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Request;
	
	class ExamAssessmentStatusController extends Controller
	{
		public function give($id) : RedirectResponse
		{
			$loading_id = request()->input('teaching_load_id');
			
			StudentExamAssessmentCategory::where(['id' => $id])->update([
				'status' => 'give'
			]);
			
			return redirectWithAlert('teacher/student-exam-assessment?teaching_load_id='.$loading_id.'', [
				'alert-success' => 'Exam Assessment has been given!'
			]);
			
			
		}
		
		
		public function ungive($id) : RedirectResponse
		{
			$loading_id = request()->input('teaching_load_id');
			
			StudentExamAssessmentCategory::where(['id' => $id])->update([
				'status' => 'ungive'
			]);
			
			return redirectWithAlert('teacher/student-exam-assessment?teaching_load_id='.$loading_id.'', [
				'alert-warning' => 'Exam Assessment has been ungive!'
			]);
		}
	}
