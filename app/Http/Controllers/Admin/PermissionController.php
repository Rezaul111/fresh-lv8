<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Resource;
use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PermissionController extends Controller
{
    public function index()
    {
        try {
           $permissions = Permission::with('resource')->latest('id')->get();
            return view('admin.permission.index',[
                'permissions'   =>  $permissions
            ]);
        }catch (Exception $ex){
            abort('403');
        }
    }

    public function create()
    {
        $resources = Resource::all();
        return view('admin.permission.create',['resources'=>$resources]);
    }

    public function store(Request $request)
    {
        Permission::checkValidation($request);
        try {
            $save_data = Permission::insertPermissionInfo($request);
            if($save_data){
                return redirect('admin/permissions')->with(['message'=>'Data inserted successfully !!','alert-type'=>'info']);
            }else{
                return redirect()->back()->with(['message'=>'Something went to wrong ??','alert-type'=>'error']);
            }
        }catch (Exception $ex){
            abort('403');
        }
    }

    public function edit(Permission $permission)
    {
        $resources = Resource::all();
        return view('admin.permission.edit',['permission'=>$permission,'resources'=>$resources]);
    }


    public function update(Request $request, Permission $permission)
    {
        Permission::updateValidation($request,$permission);
        try {
            $update_data = Permission::updatePermissionInfo($request,$permission);
            if($update_data){
                return redirect('admin/permissions')->with(['message'=>'Data updated successfully !!','alert-type'=>'info']);
            }else{
                return redirect()->back()->with(['message'=>'Something went to wrong ??','alert-type'=>'error']);
            }
        }catch (Exception $ex){
            abort('403');
        }
    }


    public function destroy(Permission $permission)
    {
        if(isset($permission)){
            $permission->delete();
            return redirect('admin/permissions')->with(['message'=>'Data deleted successfully !!','alert-type'=>'error']);
        }else{
            abort('403');
        }
    }
}
