<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;

const IMAGE_PATH = 'img/images';
class ImageController extends Controller {

    public function index() {
        $datas = Image::all();

        return ['images' => $datas];
    }

    function makePath($name, $extension) {
        return IMAGE_PATH . $name . strtotime('now') . "." . $extension;
    }

    public function store(Request $request) {
        $image = new Image;

        $image->id = $request->id;

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $extension = $request->image->extension();
            $imageName = self::makePath($request->image->GetClientOriginalName(), $extension);
            $request->image->move(public_path(IMAGE_PATH), $imageName);

            $image->path = $imageName;
        }

        $image->save();

        return $image;
    }
}
