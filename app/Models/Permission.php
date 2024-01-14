<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Permission extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function resource(){
        return $this->belongsTo(Resource::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public static function checkValidation($request){
        $request->validate([
            'resource_id'   =>  'required',
            'name'          =>  'required|string|unique:permissions',
        ]);
    }
    public static function updateValidation($request,$permission){
        $request->validate([
            'resource_id'     =>  'required',
            'name'            =>  'required|string||unique:permissions,name,'.$permission->id,
        ]);
    }
    public static function insertPermissionInfo($request){
        $permissionNames    =   explode(',',$request->name);
        foreach ($permissionNames as $permissionName){
            $permission = Permission::create([
                'resource_id'   => $request->resource_id,
                'name'          => $permissionName,
                'slug'          => Str::slug($permissionName),
                'inserted_by'   => Auth::id(),
            ]);
        }
      return $permission;
    }

    public static function updatePermissionInfo($request,$permission){
      return  $permission->update([
            'resource_id'   =>  $request->resource_id,
            'name'          =>  $request->name,
            'slug'          =>  Str::slug($request->name),
        ]);
    }
}
