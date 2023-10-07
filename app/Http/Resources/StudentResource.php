<?php

    namespace App\Http\Resources;

    use Domain\Modules\Student\Entities\Student;
    use Domain\Shared\Image;
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
    use Illuminate\Http\Resources\Json\ResourceCollection;

    class StudentResource extends JsonResource
    {

        public function toArray(Request $request): object
        {
            /**
             * @var Student $this
             */

            return (object)[
                'id'             => $this->getId(),
                'image_name'     => $this->getImage()->getImageName(),
                'image_link'     => $this->getImage()->getImageLink(),
                'id_number'      => $this->getIdNumber(),
                'complete_name'  => $this->completeName(),
                'firstname'      => $this->getFirstname(),
                'lastname'       => $this->getLastname(),
                'middlename'     => $this->getMiddlename(),
                '_birthdate'     => $this->getBirthdate(),
                'birthdate'      => $this->getBirthdateLongFormat(),
                'contact_number' => $this->getContactNumber(),
                'address'        => $this->getAddress()->value(),
                '_address'       => $this->getAddress()->minifyAddress(),
                'username'       => $this->getUsername()
            ];
        }
    }
