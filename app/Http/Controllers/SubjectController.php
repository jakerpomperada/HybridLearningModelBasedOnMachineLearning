<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\View\View;

    class SubjectController extends Controller
    {

        public function index(): View {

            return view('subject.index')->with([
                'subjects' => [],
                'paginate' => ""
            ]);
        }

        public function create(): View {
            return view('subject.create');
        }

        public function store(Request $req) {

        }



    }
