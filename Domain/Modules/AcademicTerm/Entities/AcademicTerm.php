<?php

	namespace Domain\Modules\AcademicTerm\Entities;

	use Domain\Shared\Entity;
    use Error;

    class AcademicTerm extends Entity
	{

        protected int $year_from;
        protected int $year_to;

        public function __construct(int $year_from, int $year_to, ?string $id = null)
        {
            parent::__construct($id);
            $this->year_from = $year_from;
            $this->year_to   = $year_to;

            if (!$this->shouldOneYearGap()) {
                throw new Error('Academic year should only one year gap.');
            }

            if ($this->year_from > $this->year_to) {
                throw new Error('Academic year from should less than year to.');
            }


        }

        public function getYearFrom(): int
        {
            return $this->year_from;
        }

        public function getYearTo(): int
        {
            return $this->year_to;
        }

        public function shouldOneYearGap() : bool {
           return $this->year_from - $this->year_to == -1;
        }

        public function getTerm() : string {
            return $this->year_from .'-'.$this->year_to;
        }








    }
