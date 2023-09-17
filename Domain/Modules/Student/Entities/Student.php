<?php

    namespace Domain\Modules\Student\Entities;

    use Domain\Shared\Address;
    use Domain\Shared\Entity;
    use Domain\Shared\Image;
    use Domain\Shared\User;
    use Error;
    use Illuminate\Support\Carbon;

    class Student extends Entity
    {
        protected string $id_number;
        protected string $firstname;
        protected string $middlename;
        protected string $lastname;
        protected string $birthdate;
        protected string $contact_number;
        protected Address $address;
        protected Image $image;
        protected User $user;


        public function __construct(
            string  $id_number,
            string  $firstname,
            string  $middlename,
            string  $lastname,
            string  $birthdate,
            string  $contact_number,
            Address  $address,
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

        public function setAccount(User $user): void
        {
            $this->user = $user;
        }

        public function getAccount(): User
        {
            return $this->user;
        }

        public function getImage(): Image
        {
            return $this->image;
        }

        public function setImage(Image $image): void
        {
            $this->image = $image;
        }

        public function completeName(): string
        {

            return $this->lastname . ", " . $this->firstname . " " . ucfirst(substr($this->middlename, 1));
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

        public function getBirthdateLongFormat(): string
        {
            return Carbon::parse($this->birthdate)->format('M. d, Y');
        }

        public function getContactNumber(): string
        {
            return $this->contact_number;
        }

        public function getAddress(): Address
        {
            return $this->address;
        }


        public function changePassword(string $previousHashPassword): void
        {

            if ( !empty($this->user->getPassword()) && !$this->user->isPasswordMatch($previousHashPassword)) {
                throw new Error("Previous password dont' match!");
            }

        }

        public function getPassword(): string
        {
            return $this->user->getPassword();
        }

        public function getUsername(): string
        {
            return $this->user->getUsername();
        }


    }
