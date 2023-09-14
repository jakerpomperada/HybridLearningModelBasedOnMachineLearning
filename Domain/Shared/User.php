<?php

	namespace Domain\Shared;

	use Illuminate\Support\Facades\Hash;

    class User
	{

        protected string $username;
        protected string $password;


        public function __construct(string $username, string $password)
        {
            $this->username = $username;
            $this->password = $password;
        }

        public function getUsername(): string
        {
            return $this->username;
        }

        public function getPassword(): string
        {
            return $this->password;
        }

        public function getHashPassword() : string {
            return Hash::make($this->password);
        }









    }
