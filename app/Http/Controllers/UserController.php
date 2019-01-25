<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    // PHP 7.0 allows for new to be a name of a function
    public function new(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $confirm = $user->save();

        return response()->json($confirm);
    }
}
