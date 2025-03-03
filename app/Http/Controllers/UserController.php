<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('phone')->paginate(5);

        // return $users;
        return view('user.index', ['users' => $users]);
    }
}
