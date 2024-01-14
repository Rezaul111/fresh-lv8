<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ResourceController extends Controller
{

    public function index()
    {
        try {
            $resources = Resource::latest('id')->get()??'';
            return view('admin.resource.index',['resources'=>$resources]);
        }catch (Exception $ex){
            return 'Caught exception :'.$ex->getMessage();
        }
    }

    public function create()
    {
        Gate::authorize('resource-create');
        return view('admin.resource.create');
    }

    public function store(Request $request)
    {
        try {
            $validator = Resource::checkValidation($request);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $save_data = Resource::insertResourceInfo($request);
            if($save_data){
                return redirect('admin/resources')->with(['message'=>'Data inserted successfully !!']);
            }
        }catch (Exception $ex){
            return 'Caught exception :'.$ex->getMessage();
        }
    }

    public function show(Resource $resource)
    {
        //
    }

    public function edit(Resource $resource)
    {
        Gate::authorize('resource-edit');
        return view('admin.resource.edit',['resource'=>$resource]);
    }

    public function update(Request $request, Resource $resource)
    {
        Gate::authorize('resource-update');
        try {
            $validator = Resource::updateValidation($request,$resource);
            if($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $save_data = Resource::updateResourceInfo($request,$resource);
            if($save_data){
                return redirect('admin/resources')->with(['message'=>'Data updated successfully !!']);
            }
        }catch (Exception $ex){
            return 'Caught exception :'.$ex->getMessage();
        }
    }

    public function destroy(Resource $resource)
    {
        try {
            $del = $resource->delete();
            if($del){
                return redirect('admin/resources')->with(['message'=>'Data deleted successfully !!']);
            }
        }catch (Exception $ex){
            return 'Caught exception :'.$ex->getMessage();
        }
    }
}
