<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function index()
    {
        $data = [];
        $data['users'] = User::paginate(10);
        // dd($data);
        $data['roles'] = DB::table('roles')->get();
        return view('users.index', $data);
    }
    public function change_role(Request $request)
    {
        // dd($request);

        $user =  User::find($request->user_id);
        $role = Role::find($request->role);

        if (empty($user->roles->pluck('name')->first())) {
            $user->assignRole($role);
        } else {
            $user->syncRoles($role);
        }

        return back();
    }
}
