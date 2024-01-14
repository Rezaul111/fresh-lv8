<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Module;
use Illuminate\Http\Request;
use Exception;
class ModuleController extends Controller
{
    public function index()
    {
        try {
            $modules = Module::latest('id')->get();
            return view('admin.module.index',['modules'=>$modules]);
        }catch (Exception $ex){
            abort('403');
        }
    }

    public function create()
    {
        return view('admin.module.create');
    }

    public function store(Request $request)
    {
        Module::checkValidation($request);
        try {
           $save_data =  Module::insertModuleInfo($request);
            if($save_data){
                return redirect('admin/modules')->with(['message'=>'Data inserted successfully !!','alert-type'=>'info']);
            }else{
                return redirect()->back()->with(['message'=>'Something went to wrong ??','alert-type'=>'error']);
            }
        }catch (Exception $ex){
            abort('403');
        }
    }

    public function edit(Module $module)
    {
        return view('admin.module.edit',[
            'module'    =>  $module,
        ]);
    }

    public function update(Request $request, Module $module)
    {
        Module::updateValidation($request,$module);
        try {
            $update_data =  Module::updateModuleInfo($request,$module);
            if($update_data){
                return redirect('admin/modules')->with(['message'=>'Data updated successfully !!','alert-type'=>'info']);
            }else{
                return redirect()->back()->with(['message'=>'Something went to wrong ??','alert-type'=>'error']);
            }
        }catch (Exception $ex){
            abort('403');
        }
    }

    public function destroy(Module $module)
    {
        if(isset($module)){
            $module->delete();
            return redirect('admin/modules')->with(['message'=>'Data deleted successfully !!','alert-type'=>'error']);
        }else{
            abort('403');
        }
    }
}
