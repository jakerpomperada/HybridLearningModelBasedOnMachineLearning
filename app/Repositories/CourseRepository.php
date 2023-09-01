<?php

    namespace App\Repositories;


    use App\Models\Course as CourseDB;
    use Domain\Modules\Course\Entities\Course;
    use Domain\Modules\Course\Repositories\ICourseRepository;
    use Illuminate\Contracts\Pagination\Paginator;
    use Illuminate\Support\Facades\DB;

    class CourseRepository implements ICourseRepository
    {

        public function Save(Course $course): void
        {
            DB::table('courses')->insert([
                'id'          => $course->getId(),
                'code'        => $course->getCode(),
                'description' => $course->getDescription(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }

        public function Update(Course $course): void
        {
           DB::table('courses')->where(['id' => $course->getId()])->update([
               'code'        => $course->getCode(),
               'description' => $course->getDescription(),
               'updated_at'  => now(),
           ]);
        }

        public function Delete(string $id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit): Paginator
        {
            return CourseDB::paginate($limit);
        }

        public function Find(string $id): object|null
        {
            return DB::table('courses')->where(['id' => $id])->first();
        }
    }
