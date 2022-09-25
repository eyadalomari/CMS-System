<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
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

        return view('admin.roles.edit',[
            'role'=>$role,
            'permissions'=>Permission::all()
        ]);
    }




    public function update(Role $role){

        request()->validate([
            'name'=>['required'],
        ]);

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(Str::lower(request('name')))->slug('-');

        if($role->isDirty('name')){
            session()->flash('role-message-update', $role->name. " has been updated");
            $role->save();
            return redirect(route('role.index'));

        } else {
            session()->flash('role-message-update', "Nothing has been updated!");
            return back();
            
        }
        
    }

    public function attach_permission(Role $role){
        $permission = request()->permission;
        $role->permissions()->attach($permission);

        return back();
    }

    public function detach_permission(Role $role){
        $permission = request()->permission;
        $role->permissions()->detach($permission);

        return back();
    }
}
