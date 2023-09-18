<?php

    namespace App\Http\Resources;

    use Domain\Modules\AcademicTerm\Entities\AcademicTerm;
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class AcademicTermResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request)
        {
            /**
             * @var AcademicTerm $this
             */

            return (object) [
                'id'            => $this->getId(),
                'academic_year' => $this->getTerm(),
                'year_from'     => $this->getYearFrom(),
                'year_to'       => $this->getYearTo()
            ];
        }
    }
