<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller {
    public function index() {
        $users = User::all();

        return ['user' => $users];
    }

    public function create(Request $request) {
        $user = new user;

        $user->name = $request->name;
        $user->email = $request->email;

        $hash = password_hash($request->password, PASSWORD_DEFAULT);
        $user->password = $hash;

        $user->save();

        return $user;
    }
}
