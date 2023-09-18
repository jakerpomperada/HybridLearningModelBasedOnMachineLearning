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
            $term = new AcademicTerm($this->year_from, $this->year_to, $this->id);
            return (object) [
                'id'            => $term->getId(),
                'academic_year' => $term->getTerm()
            ];
        }
    }
