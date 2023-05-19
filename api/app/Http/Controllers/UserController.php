<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller {
    function validateIfIdOfUserExists($id) {
        $user = User::find($id);

        if(!$user) {
            return ['message' => 'Id is not valid!'];
        }

        return ['message' => 'Id is valid!'];
    }

    public function all() {
        $users = User::all();

        return ['users' => $users];
    }

    public function create(Request $request) {       
        if(!$request->name) {
            return ['message' => 'name is required'];
        }
        
        if(!$request->email) {
            return ['message' => 'email is required'];
        }

        if(!$request->password) {
            return ['message' => 'password is required'];
        }

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

    public function update(Request $request) {
        if(!$request->id) {
            return ['message' => 'id is required'];
        }

        $idValidation = self::validateIfIdOfUserExists($request->id);
        
        if ($idValidation) { return $idValidation; }

        $data = $request->all();

        $user = User::findOrFail($request->id)->update($data);

        return [ 'message' => 'User updated successfuly!' ];
    }

    public function find(Request $request) {
        if(!$request->id) {
            return ['message' => 'id is required'];
        }
        
        $user = User::findOrFail($request->id);

        return ['user' => $user];
    }
}
