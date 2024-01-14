<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public static function checkValidation($request){
        $request->validate([
            'name'          => 'required|unique:roles',
            'permissions'   =>  'required|array',
            'permissions.*' =>  'integer',
        ]);
    }
    public static function updateValidation($request,$role){
        $request->validate([
            'name'          => 'required|unique:roles,name,'.$role->id,
            'permissions'   =>  'required|array',
            'permissions.*' =>  'integer',
        ]);
    }

    public static function insertRoleInfo($request){

     return  Role::create([
            'name'          =>  $request->name??'',
            'slug'          =>  Str::slug($request->name)??'',
            'inserted_by'   =>  Auth::id()??'',
        ])->permissions()->sync($request->input('permissions'));

    }
    public static function updateRoleInfo($request,$role){
       $data = $role->update([
            'name'  =>  $request->name,
            'slug'  => Str::slug($request->name),
        ]);
      $role->permissions()->sync($request->input('permissions'));
      return $data;
    }
}
