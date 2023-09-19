<?php

    namespace App\Http\Resources;

    use Domain\Modules\Subject\Entities\Subject;
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class SubjectResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array
        {
            $subject = new Subject($this->code, $this->description, $this->id);

            return [
                'id'          => $subject->getId(),
                'code'        => $subject->getCode(),
                'description' => $subject->getDescription(),
            ];
        }
    }
