<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PermissionController extends Controller
{

    public function index()
    {
        return view('admin.permissions.index', ['permissions'=> Permission::all()]);
    }


    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required']
        ]);

        $permission = new Permission;
        $permission->name = Str::ucfirst($request['name']);
        $permission->slug = Str::of(Str::lower($request['name']))->slug('-');
        $permission->save();

        session()->flash('permission-created', $permission->name. ' Has been created');

        return back();

    }

    
    public function show(Permission $permission)
    {
        //
    }

   
    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', ['permission' => $permission]);
    }

   
    public function update(Permission $permission)
    {
        request()->validate([
            'name' => ['required']
        ]);

        $permission->name = Str::ucfirst(request()->name);
        $permission->slug = Str::of(Str::lower(request()->name))->slug('-');
        

        if($permission->isDirty('name')){
            session()->flash('permission-message-update', $permission->name . ' has been updated');
            $permission->save();
            return redirect(route('permission.index'));

        } else{
            session()->flash('permission-message-update', ' Nothing to updated');
            return back();
        }


    }

  
    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('permission-message-delete', $permission->name. ' was deleted');
        return back();
    }
}
