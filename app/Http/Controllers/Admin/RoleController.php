<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Resource;
use App\Models\Role;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Str;

class RoleController extends Controller
{

    public function index()
    {
        try {
           $roles  =   Role::latest('id')->get()??'';
            return view('admin.role.index',[
                'roles' =>  $roles
            ]);
        }catch (Exception $ex){
            abort('403');
        }
    }


    public function create()
    {
        return view('admin.role.create',[
            'resources'  => Resource::all(),
        ]);
    }


    public function store(Request $request)
    {
        Role::checkValidation($request);
        try {
            $save_data = Role::insertRoleInfo($request);
            if($save_data){
                return  redirect('admin/roles')->with(['message'=>'Data updated successfully !!','alert-type'=>'info']);
            }else{
                return back()->with(['message'=>'Something went to wrong ??','alert-type'=>'error']);
            }
        }catch (Exception $ex){
            abort('404');
        }
        return redirect('admin/roles')->with(['message'=>'Data inserted successfully !!','alert-type'=>'info']);
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        $resources = Resource::all();
        return view('admin.role.edit',[
            'resources'     =>  $resources,
            'role'          =>  $role,
        ]);
    }


    public function update(Request $request, Role $role)
    {
        Role::updateValidation($request,$role);
        try {
            $update_data = Role::updateRoleInfo($request,$role);
            if($update_data){
                return redirect('admin/roles')->with(['message'=>'Data updated successfully !!','alert-type'=>'info']);
            }else{
                return redirect()->back()->with(['message'=>'Something went to wrong ??','alert-type'=>'error']);
            }
        }catch (Exception $ex){
            abort('404');
        }

    }


    public function destroy(Role $role)
    {
        if(isset($role)){
            $role->delete();
            return redirect('admin/roles')->with(['message'=>'Data deleted successfully !!.','alert-type'=>'error']);
        }else{
            return abort('404');
        }
    }
}
