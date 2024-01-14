<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function index()
    {
        try {
            $users = User::with('roles')->latest('id')->get()??'';
            return view('admin.user.index',['users'=>$users]);
        }catch (Exception $ex){
            abort('403');
        }
    }

    public function create()
    {
        Gate::authorize('user-create');
        return view('admin.user.create',['roles'=>Role::all()]);
    }

    public function store(Request $request)
    {
        User::checkValidation($request);
        try {
            $save_data = User::insertUserInfo($request);
            if($save_data){
                return redirect('admin/users')->with(['message'=>'Data inserted successfully !!','alert-type'=>'info']);
            }else{
                return redirect('admin/users')->with(['message'=>'Something went to wrong ?? ','alert-type'=>'error']);
            }
        }catch (Exception $ex){
            abort('404');
        }
    }

    public function status($id)
    {
        $user = User::findOrFail($id)??'';
        if($user->status == 1){
            $user->status = 0;
            $user->save();
        }elseif ($user->status == 0){
            $user->status = 1;
            $user->save();
        }
        return redirect('admin/users')->with(['message'=>'Users status updated successfully !!.','alert-type'=>'info']);
    }

    public function edit(User $user)
    {

//        Gate::authorize('edit-user');
        $roles = Role::all()??'';
        return view('admin.user.edit',[
            'user'      =>  $user??'',
            'roles'     =>  $roles,
        ]);
    }


    public function update(Request $request, User $user)
    {
        try {
            $update_data = User::updateUserInfo($request,$user);
            if($update_data){
                return  redirect('admin/users')->with(['message'=>'Data updated successfully !!.','alert-type'=>'info']);
            }else{
                return redirect()->back()->with(['message'=>'Something went to wrong ??','alert-type'=>'error']);
            }

        }catch (Exception $ex){
            abort('404');
        }
    }

    public function destroy(User $user)
    {
        //
    }
}
