<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Resource extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
    public static function checkValidation($request){
        return Validator::make($request->all(),[
            'name'  =>  'required|string|unique:resources',

        ],  [
                'name.required' =>  'Resource name field is required',
                'name.string'   =>  'Resource name field must be text character',
                'name.unique'   =>  'Already exist this name.',
            ]
        );
    }
    public static function updateValidation($request,$resource){
        return Validator::make($request->all(),[
            'name'  =>  'required|string|unique:resources,name, '.$resource->id,

        ],  [
                'name.required' =>  'Resource name field is required',
                'name.string'   =>  'Resource name field must be text character',
                'name.unique'   =>  'Already exist this name.',
            ]
        );
    }
    public static function insertResourceInfo($request){
        $resource =  Resource::create([
            'name'          =>  $request->name??'',
            'inserted_by'   =>  Auth::id()??''
        ]);
        return $resource;
    }
    public static function updateResourceInfo($request,$resource){
        $resource   =   $resource->update([
            'name'  =>  $request->name??'',
        ]);
        return $resource;
    }
}
