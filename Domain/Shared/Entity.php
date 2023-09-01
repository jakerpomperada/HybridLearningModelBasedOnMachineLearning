<?php

    namespace Domain\Shared;

    use Ramsey\Uuid\Uuid;

    abstract class Entity
    {
        protected string $id;

        public function __construct($id)
        {
            $this->id = $id ?? Uuid::uuid4();
        }

        public function getId(): string
        {
            return  trim($this->id);
        }

    }
