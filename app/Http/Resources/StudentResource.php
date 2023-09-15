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
            $st = new Student(
                $this->id_number,
                $this->firstname,
                $this->lastname,
                $this->middlename,
                $this->birthdate,
                $this->contact_number,
                $this->address,
                $this->id
            );
            $st->setImage(new Image($this->image_name));
            return (object) [
                'id'             => $st->getId(),
                'image_name'     => $st->getImage()->getImageName(),
                'image_link'     => $st->getImage()->getImageLink(),
                'id_number'      => $st->getIdNumber(),
                'complete_name'  => $st->completeName(),
                'birthdate'      => $st->getBirthdateLongFormat(),
                'contact_number' => $st->getContactNumber(),
                'address'        => $st->getAddress(),
            ];
        }
    }
