<?php
	
	namespace Domain\Modules\User\Repositories;
	
	interface IUserRepository
	{
		public function FindByUsername(string $username) : object | null;
	}