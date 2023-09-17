<?php

	namespace Domain\Shared;

	class Address
	{
        protected string $address;


        public function __construct(?string $address = "")
        {
            $this->address = $address;
        }

        public function value(): string {
            return $this->address;
        }

        public function minifyAddress() : string {
            return mb_strimwidth($this->address, 0, 25, "...");
        }


    }
