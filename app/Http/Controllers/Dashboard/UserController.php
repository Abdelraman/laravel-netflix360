<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_users')->only(['index']);
        $this->middleware('permission:create_users')->only(['create', 'store']);
        $this->middleware('permission:update_users')->only(['edit', 'update']);
        $this->middleware('permission:delete_users')->only(['destroy']);

    }// end of __construct

    public function index()
    {
        $roles = Role::whereRoleNot('super_admin')->get();

        $users = User::whereRoleNot('super_admin')
            ->whenSearch(request()->search)
            ->whenRole(request()->role_id)
            ->with('roles')
            ->paginate(5);

        return view('dashboard.users.index', compact('roles', 'users'));

    }//end of index

    public function create()
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin'])->get();
        return view('dashboard.users.create', compact('roles'));

    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role_id' => 'required|numeric',
        ]);

        $request->merge(['password' => bcrypt($request->password)]);

        $user = User::create($request->all());
        $user->attachRoles(['admin', $request->role_id]);

        session()->flash('success', 'Data added successfully');
        return redirect()->route('dashboard.users.index');

    }//end of store

    public function edit(User $user)
    {
        $roles = Role::whereRoleNot(['super_admin', 'admin',])->get();
        return view('dashboard.users.edit', compact('user', 'roles'));

    }//end of edit

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role_id' => 'required|numeric',
        ]);

        $user->update($request->all());
        $user->syncRoles(['admin', $request->role_id]);

        session()->flash('success', 'Data updated successfully');
        return redirect()->route('dashboard.users.index');

    }//end of update

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'Data deleted successfully');
        return redirect()->route('dashboard.users.index');

    }//end of destroy

}//end of controller
