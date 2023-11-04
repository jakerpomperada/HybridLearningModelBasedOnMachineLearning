<?php
	
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Support\Facades\Redirect;
	use Illuminate\Support\Str;
	use Illuminate\Validation\Validator;
	
	
	function getRole(): string
	{
		if (session('role') == 'admin') {
			return 'Administrator';
		}
		return ucfirst(session('role'));
	}
	
	function yearLevel(string $level): string
	{
		return match ($level) {
			'1st' => 'First Year',
			'2nd' => 'Second Year',
			'3rd' => 'Third Year',
			default => 'Fourth Year',
		};
	}
	
	function semester(string $sem): string
	{
		return match ($sem) {
			'1st' => 'First Semester',
			default => 'Second Semester',
		};
	}
	
	function shortenString($string)
	{
		if (strlen($string) > 15) {
			return substr($string, 0, 15) . '...';
		}
		return $string;
	}
	
	
	function validateErrorResponse(Validator $validator): JsonResponse
	{
		return response()->json([
			'errmsg' => $validator->getMessageBag()->all()[0]
		], 500);
	}
	
	function successResponse(array $data): JsonResponse
	{
		
		return response()->json([
			'success' => true,
			'data'    => $data
		]);
	}
	
	function redirectWithErrors(Validator $validator): RedirectResponse
	{
		return Redirect::back()->withErrors($validator->getMessageBag()->all()[0]);
	}
	
	function redirectWithInput(Validator $validator): RedirectResponse
	{
		return Redirect::back()->withInput()->withErrors($validator->getMessageBag()->all()[0]);
	}
	
	function redirectExceptionWithInput(Error $validator): RedirectResponse
	{
		return Redirect::back()->withInput()->withErrors($validator->getMessage());
	}
	
	
	function redirectWithAlert(string $loc, array $alert): RedirectResponse
	{
		return Redirect::to($loc)->with($alert);
	}
	
	function uuid(): string
	{
		return Str::uuid();
	}
