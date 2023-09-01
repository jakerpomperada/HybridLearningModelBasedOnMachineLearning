<?php

    namespace Domain\Modules\Course\Entities;

	use Domain\Shared\Entity;

    class Course extends Entity
	{
        protected string $code;
        protected string $description;

        public function __construct(string $code, string $description, ?string $id = null)
        {

            parent::__construct($id);

            $this->code = $code;
            $this->description = $description;
        }


        public function getCode(): string
        {
            return $this->code;
        }


        public function getDescription(): string
        {
            return $this->description;
        }




    }
