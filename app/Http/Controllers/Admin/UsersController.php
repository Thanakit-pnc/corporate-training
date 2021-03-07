<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web');
    }

    public function index() {

        $users = User::all();

        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ]);
        } 

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
        
        return response()->json([
            'success' => true,
        ]);
    }

    public function edit($id) {

        $user = User::find($id);

        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id) {
        
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required',
            'role' => 'required',
        ]);
        
        $user = User::find($id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
        ]);

        return back()->with(['msg' => 'Update Successfully.']);
    }

    public function update_password(Request $request, $id) {      

        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed'
        ]);
        
        $user = User::find($id)->update([
            'password' => bcrypt($request->password),
        ]);

        return back()->with(['msg' => 'Update Password Successfully.']);
    }

    public function delete_user($id) {

        $user = User::find($id)->delete();

        return response()->json(['msg' => 'success']);
    }
}
