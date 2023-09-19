<?php

    namespace App\Http\Resources;

    use Domain\Modules\Course\Entities\Course;
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;

    class CourseResource extends JsonResource
    {
        /**
         * Transform the resource into an array.
         *
         * @return array<string, mixed>
         */
        public function toArray(Request $request): array
        {

            $course = new Course($this->code,$this->description, $this->id);



            return [
                'id'          => $course->getId(),
                'code'        => $course->getCode(),
                'description' => $course->getDescription()
            ];
        }
    }
