<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller {
    public function all() {
        $users = User::all();

        return ['users' => $users];
    }

    public function create(Request $request) {
        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;

        $hash = password_hash($request->password, PASSWORD_DEFAULT);
        $user->password = $hash;

        $user->save();

        return $user;
    }

    public function delete($id) {
        User::findOrFail($id)->delete();

        return [ 'message' => 'User removed successfully!' ];
    }
}
