<?php

    namespace Domain\Modules\AcademicTerm\Repositories;

    use Domain\Modules\AcademicTerm\Entities\AcademicTerm;
    use Illuminate\Contracts\Pagination\Paginator;
    use Ramsey\Collection\Collection;

    interface IAcademicTermRepository
    {
        public function Save(AcademicTerm $academicTerm): void;

        public function Update(AcademicTerm $academicTerm): void;

        public function Delete(string $id): void;

        public function GetAllPaginate(int $page, int $limit): object;

        public function GetAll(): object;

        public function Find(string $id): AcademicTerm|null;

        public function GetSemesters(): array;

        public function SaveSubjectTerm(
            string $academic_term_semester_id,
            string $course_id,
            string $subject_id,
            string $year_level
        ): void;

        public function FindAcademicSemester(string $academic_id, string $semester): object|null;

        public function GetAllSubjectTermPaginate(int $page, int $limit) : Paginator;




    }
