<?php

	namespace App\Http\Controllers;

	use App\Events\ChangeSemesterTermEvent;
    use App\Models\Student;
	use App\Models\Teacher;
    use Domain\Modules\AcademicTerm\Repositories\IAcademicTermRepository;
    use Domain\Modules\User\Entities\User;
	use Domain\Modules\User\Repositories\IUserRepository;
    use Domain\Shared\AcademicTerm;
    use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Session;
	use Error;
	use App\Models\User as UserDB;

	class LoginController extends Controller
	{


		protected IUserRepository $userRepository;
        protected IAcademicTermRepository $academicTermRepository;


        public function __construct(IUserRepository $userRepository, IAcademicTermRepository $academicTermRepository)
        {
            $this->userRepository = $userRepository;
            $this->academicTermRepository = $academicTermRepository;
        }


        public function index()
		{
			return view('login.index');
		}

		public function login(Request $request)
		{

			try {
				$username = $request->input('username');
				$password = $request->input('password');


                $ud = $this->userRepository->FindByUsername($username);

				if (!$ud) throw new Error('Username not exists');

                $user = new User($username, $password, $ud->id);

				if (!$user->isPasswordMatch($ud->password)) {
					throw new Error("Password not match");
				}

				$role = $ud->type;

				$user = UserDB::find($ud->id);

				Auth::login($user);
				Session::put([
					'username' => $username,
					'role'     => $role,
				]);

                event(new ChangeSemesterTermEvent($this->getCurrentTerm()));


				if ($role == 'admin') {
					return redirect('admin/dashboard');
				} elseif ($role == 'student') {
					$teacher = Student::where(['user_id' => $user->id])->first();
					Session::put(['complete_name' => $teacher->completeName()]);

					return redirect('student/dashboard');
				} else {
					$teacher = Teacher::where(['user_id' => $user->id])->first();
					Session::put(['complete_name' => $teacher->completeName()]);

					return redirect('teacher/dashboard');
				}
			} catch (Error $error) {
				return redirectExceptionWithInput($error);
			}


		}
	}
