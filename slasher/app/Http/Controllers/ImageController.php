<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function index()
    {
        return view('image');
    }

    public function save(StoreImageRequest  $request)
    {
        $validatedData = $request->validated();

        if ($files = $request->file('fileUpload')) {
            $file =  $request->file('fileUpload')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            $destinationPath = 'public/image/'; // upload path
            $profileImage = $filename;//date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $insert['image'] = "$profileImage";
            $insert['extension'] = $extension;
        }
        $check = Image::insertGetId($insert);

        return Redirect::to("image")
            ->withSuccess('Great! Image has been successfully uploaded.');

    }

    public function edit($id)
    {
        $image = Image::find($id);
        return view('imageEdit' , compact('image'));

    }

    public function update($id  , Request $request)
    {
        $validatedData = $request->validated();

        if ($files = $request->file('fileUpload')) {
            $file =  $request->file('fileUpload')->getClientOriginalName();
            $filename = pathinfo($file, PATHINFO_FILENAME);
            $extension = pathinfo($file, PATHINFO_EXTENSION);


            $destinationPath = 'public/image/'; // upload path
            $profileImage = $filename;//date('YmdHis') . "." . $files->getClientOriginalExtension();
            $files->move($destinationPath, $profileImage);
            $insert['image'] = "$profileImage";
            $insert['extension'] = $request->input('extension');
        }
        Image::whereId($id)->update($insert);

        return redirect()->route('image.edit', [$id]);

    }
}
