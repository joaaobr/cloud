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
        $user->password = $request->password;

        $user->save();

        return $user;
    }
}
