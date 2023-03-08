<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Image;

use App\Models\User;

const IMAGE_PATH = 'img/images';

class ImageController extends Controller {

    public function index() {
        $images = Image::all();

        return ['images' => $images];
    }

    function makePath($name, $extension) {
        return IMAGE_PATH . $name . strtotime('now') . "." . $extension;
    }


    public function store(Request $request) {
        $image = new Image;

        $user = User::find($request->id);

        if(!$user) {
            return ['message' => 'id is nor valid!'];
        }

        $image->id_user = $request->id;

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
