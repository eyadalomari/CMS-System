<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Str;


class RoleController extends Controller
{
    public function index(){

        return view('admin.roles.index', ['roles' => Role::all()]);
    }

    public function store(){

        request()->validate([
            'name'=>['required'],
        ]);

        $role = new Role;
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');
        $role->save();
        return back();
    }

    public function destroy(Role $role){
        
        request()->session()->flash('role-deleted-message', $role->name . ' was deleted');

        $role->delete();
        return back();
    }


    public function edit(Role $role){
        return view('admin.roles.edit',['role'=>$role]);
    }

    public function update(Role $role){
        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');
        $role->save();

        session()->flash('role-message-update', $role->name. " has been updated");
        return redirect(route('role.index'));
    }
}
