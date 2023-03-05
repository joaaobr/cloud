<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Data;

class DataController extends Controller
{
    public function index() {
        $datas = Data::all();

        return ['datas' => $datas];
    }

    public function store(Request $request) {
        $data = new Data;

        $data->name = $request->name;
        $data->email = $request->email;

        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $extension = $request->image->extension();
            $request->image->move(public_path('img/datas'), $request->image->GetClientOriginalName() . strtotime('now') . "." . $extension);
            $data->path = $request->image->GetClientOriginalName() . strtotime('now') . "." . $extension;
        }

        $data->save();

        return $data;
    }

    public function find() {
        
    }
}