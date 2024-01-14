@extends('admin.dashboard.master')
@section('title','Roles')
@section('body')
    <div class="page-wrapper ">
        <div class="page-breadcrumb" style="border-bottom: 2px solid lightgray">
            <div class="row py-3 ">
                <div class="col-5 align-self-center">
                    <h5 class="page-title text-uppercase" style="font-family: 'Bell MT';font-size: 16px"><i class="mdi mdi-checkbox-marked-outline mr-2 "></i>Roles Module</h5>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"> <a href="{{url('admin/dashboard')}}" class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{route('roles.index')}}" class="text-warning">Roles List</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('admin.error.error-msg')
                </div>
            </div>
            <div class="row">
                <div class="col-12 mt-4">
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom">
                            <i class="fa fa-plus-circle mr-2"></i> Edit Role Form
                        </div>
                        <div class="card-body">
                            <form action="{{route('roles.update',$role)}}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="form-group">
                                    <label for="name">Role Name :</label>
                                    <input type="text" name="name" value="{{$role->name ?? ''}}" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter role name . . ." />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="my-lg-4  mx-auto">
                                    <strong class="text-primary font-18"><i class="fa fa-angle-double-right mr-2 text-danger"></i> Manage Permissions for Roles : </strong>
                                    @error('permissions')
                                    <p class="text-danger">
                                        <strong>{{$message}}</strong>
                                    </p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="custom-checkbox custom-control">
                                        <input type="checkbox" class="custom-control-input" id="select-all"/>
                                        <label for="select-all" class="custom-control-label"> Select All </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            @forelse($resources as $resource)
                                                <div class="col-4">
                                                    <div class="mb-2"> Module : <strong class="ml-2 text-info"> {{$resource->name}} </strong></div>
                                                    @foreach($resource->permissions as $key=>$permission)
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="permissions[]" class="all-checkbox"  value="{{$permission->id}}" @foreach($role->permissions as $rPermission) {{$permission->id == $rPermission->id ? 'checked':''}} @endforeach/>
                                                            <label class="ml-2">{{$permission->slug}}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @empty
                                                <div class="text-danger text-center">No module found (: </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-lg-5">
                                    <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-alt-circle-up mr-1"></i> UPDATE </button>
                                    <a href="{{route('roles.index')}}" class="btn btn-outline-danger ml-2 btn-sm"><i class="fas fa-arrow-circle-left mr-1"></i>BACK</a>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function (){
            $('#select-all').click(function (){
                if(this.checked){
                    $(':checkbox').each(function (){
                        this.checked = true;
                    });
                }else {
                    $(':checkbox').each(function (){
                        this.checked = false;
                    });
                }
            });
			 if($('.all-checkbox:checked').length == $('.all-checkbox').length){
               $('#select-all').prop('checked',true);
           }
        });
    </script>
@endpush

