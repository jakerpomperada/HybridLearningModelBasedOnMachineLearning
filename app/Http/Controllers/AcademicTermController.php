<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class AcademicTermController extends Controller
    {

        public function index() {

            return view('academic-term.index')->with([
                'terms' => [],
                'paginate' => ''
            ]);
        }
    }
