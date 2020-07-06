<?php

namespace App\Http\Controllers;

use App\Services\MLearnService;
use Illuminate\Http\Request;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

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
        return MLearnService::createUser($user);
    }

    public function changeLevel(Request $request, $id)
    {
        $action = explode('/', $request->path())[2];
        $user = User::findOrFail($id);
        return MLearnService::changeUserLevel($user, $action);
    }
}
