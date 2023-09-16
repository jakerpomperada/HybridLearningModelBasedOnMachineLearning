<?php

	namespace Domain\Shared;

	use Illuminate\Support\Facades\Hash;

    class User extends Entity
	{

        protected string $username;
        protected string $password;


        public function __construct(string $username, ?string $password, ?string $id = null)
        {
            parent::__construct($id);
            $this->username = $username;
            $this->password = $password ?? "";
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

        public function isPasswordMatch(string $hash_password) : bool {
            return Hash::check($this->password,$hash_password);
        }

        public function setPassword(string $password)  : void {
            $this->password = $password;
        }










    }
