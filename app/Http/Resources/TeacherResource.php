<?php

    namespace App\Http\Resources;


    use Domain\Modules\Teacher\Entities\Teacher;
    use Domain\Shared\Image;
    use Illuminate\Support\Collection;

    class TeacherResource
    {

        protected array $data;

        /**
         * @param array $data
         */
        public function __construct(array $data)
        {
            $this->data = $data;
        }

        public function data(): Collection
        {
            return collect($this->data)->map(function ($d) {
                $t = new Teacher(
                    $d->id_number,
                    $d->firstname,
                    $d->lastname,
                    $d->middlename,
                    $d->birthdate,
                    $d->contact_number,
                    $d->address,
                    $d->id
                );
                $t->setImage(new Image($d->image));

                return (object)[
                    'id'             => $t->getId(),
                    'image'          => $t->getImage()->getImageLink(),
                    'id_number'      => $t->getIdNumber(),
                    'complete_name'  => $t->completeName(),
                    'birthdate'      => $t->getBirthdateLongFormat(),
                    'contact_number' => $t->getContactNumber(),
                    'address'        => shortenString($t->getAddress()),
                ];
            });

        }


    }
