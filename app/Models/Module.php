<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function permissions(){
        return $this->hasMany(Permission::class);
    }

    public static function checkValidation($request){
        $request->validate([
            'name'  =>  'required|string|unique:modules'
        ]);
    }
    public static function updateValidation($request,$module){
        $request->validate([
            'name'  =>  'required|string|unique:modules,name,'.$module->id,
        ]);
    }
    public static function insertModuleInfo($request){
     return   Module::create([
            'name'  =>  $request->name,
        ]);
    }
    public static function updateModuleInfo($request,$module){
       return $module->update([
            'name'  =>  $request->name,
        ]);
    }
}
