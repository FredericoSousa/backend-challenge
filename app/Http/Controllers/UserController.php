<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return User::paginate(10);
    }

    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|size:11',
            'level' => 'required|in:F,P'
        ]);
        $user = User::create($data);
        return $user;
    }
}
