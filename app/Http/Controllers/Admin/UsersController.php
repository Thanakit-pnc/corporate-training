<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('auth:web');
    }

    public function index() {

        $users = User::all();

        return view('admin.users', [
            'users' => $users
        ]);
    }

    public function store(Request $request) {

        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|unique:users.username',
            'password' => 'required',
            'role' => 'required',
        ]);

        if($errors->any()) {
            return response()->json($errors->all(), 200);
        }
        
    }
}
