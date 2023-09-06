<?php

	namespace Domain\Shared;

	class Image
	{
        protected string $image_name;


        public function __construct(?string $image_name  = null)
        {
            $this->image_name = $image_name ?? 'temp.jpg';
        }

        public function getImageName(): string {
            return $this->image_name;
        }

        public function getUploadPath() {

        }

        public function getImageLink() : string {
            return config('app.url') . "/storage/images/" . $this->image_name;
        }


    }
