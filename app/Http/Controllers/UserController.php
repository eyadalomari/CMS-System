<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;


class UserController extends Controller
{

    public function index(){
        $this->authorize('view', auth()->user());

        $users = User::paginate(20);;
        return view('admin.users.index', ['users'=>$users]);
    }



    public function show(User $user){
        return view('admin.users.profile', [
            'user'=>$user, 
            'roles'=>Role::all()
        ]);
    }

    public function update(User $user){
        $inputs = request()->validate([
            'username' => ['required', 'string', 'max:255', 'alpha_dash'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'avatar' => ['file'],

            //'password' => ['min:8', 'max:255', 'confirmed'],
            //'password-confirmation' => ['min:8', 'max:255', 'confirmed'],
            
        ]);

        

        if(request('avatar')){
            $inputs['avatar'] = request('avatar')->store('images');
        }

        $user->update($inputs);
        return back();        
    }


    public function destroy(User $user){
        $this->authorize('delete', $user);
        
        $user->delete();
        request()->session()->flash('user-deleted-message', "User was deleted");
        return back();
    }


    public function attach(User $user){
        $user->roles()->attach(request()->role);
        return back();
    }


    public function detach(User $user){
        $user->roles()->detach(request()->role);
        return back();
    }



    //API Functions
    public function getAllUsers(){
        return User::all();
    }
}
