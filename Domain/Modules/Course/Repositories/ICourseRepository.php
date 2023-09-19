<?php

    namespace Domain\Modules\Course\Repositories;



    use Domain\Modules\Course\Entities\Course;
    use Illuminate\Contracts\Pagination\Paginator;

    interface ICourseRepository
    {

        public function Save(Course $course): void;

        public function Update(Course $course): void;

        public function Delete(string $id): void;

        public function GetAllPaginate(int $page, int $limit) : Paginator;

        public function GetAll() : object;

        public function Find(string $id): object | null;

    }
