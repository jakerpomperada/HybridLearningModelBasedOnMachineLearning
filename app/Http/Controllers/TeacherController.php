<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use Illuminate\View\View;

    class TeacherController extends Controller
    {
        public function index(): View
        {
            $teachers = [];

            return view('teacher.index')->with([
                'teachers'   => $teachers,
                'paginate' => ''
            ]);
        }

        public function create() : View {
            return view('teacher.create');
        }
    }
