<?php

	namespace Domain\Modules\Teacher\Entities;
	use Domain\Shared\Entity;
    use Domain\Shared\Image;

    class Teacher extends Entity
	{
        protected string $id_number;
        protected string $firstname;
        protected string $middlename;
        protected string $lastname;
        protected string $birthdate;
        protected string $contact_number;
        protected string $address;
        protected Image $image;


        public function __construct(
            string $id_number,
            string $firstname,
            string $middlename,
            string $lastname,
            string $birthdate,
            string $contact_number,
            string $address,
            ?string $id = null)
        {
            parent::__construct($id);
            $this->id_number      = $id_number;
            $this->firstname      = $firstname;
            $this->middlename     = $middlename;
            $this->lastname       = $lastname;
            $this->birthdate      = $birthdate;
            $this->contact_number = $contact_number;
            $this->address        = $address;
        }

        public function getImage(): Image
        {
            return $this->image;
        }

        public function setImage(Image $image): void
        {
            $this->image = $image;
        }


        public function getIdNumber(): string
        {
            return $this->id_number;
        }

        public function getFirstname(): string
        {
            return $this->firstname;
        }

        public function getMiddlename(): string
        {
            return $this->middlename;
        }

        public function getLastname(): string
        {
            return $this->lastname;
        }

        public function getBirthdate(): string
        {
            return $this->birthdate;
        }

        public function getContactNumber(): string
        {
            return $this->contact_number;
        }

        public function getAddress(): string
        {
            return $this->address;
        }





    }
