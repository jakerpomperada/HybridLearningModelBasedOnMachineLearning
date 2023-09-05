<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;

    class UploadImageController extends Controller
    {
        public function store(Request $req)
        {
            $image = $req->file('image');

            $imageName = time() . '.' . $image->extension();

            $upload = $image->move(storage_path('images'), $imageName);

            return response()->json([
                'success'    => true,
                'is_upload'  => $upload,
                'image_name' => $imageName
            ]);
        }
    }
