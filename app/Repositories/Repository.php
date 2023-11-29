<?php

	namespace App\Repositories;

	use Illuminate\Support\Facades\DB;

    class Repository
	{

        public function query(string $sql) : array {
            $result =  DB::select($sql) ;
            return !$result ? [] : $result;
        }

        public function find_query(string $sql) : object | null {
            $result = $this->query($sql);
            return !$result ? (object) [] : (object) array_shift($result);
        }

	}
