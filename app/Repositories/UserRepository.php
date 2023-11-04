<?php
	
	namespace App\Repositories;
	
	use Domain\Modules\User\Repositories\IUserRepository;
	use Illuminate\Support\Facades\DB;
	
	class UserRepository implements IUserRepository
	{
		
		public function FindByUsername(string $username): object|null
		{
		  return DB::table('users')->where(['username' => $username])->first();
		}
	}