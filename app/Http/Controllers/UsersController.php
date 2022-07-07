<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;



class UsersController extends Controller
{
    public function index()
    {
        $data = [];
        $data['users'] = User::paginate(10);
        // dd($data);
        return view('users.index', $data);
    }
}
