<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = UserModel::where('usernmae', 'manager9')->findOrFail();
        return view('user', ['data' => $user]);
    }
}
