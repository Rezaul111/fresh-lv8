@extends('admin.dashboard.master')
@section('title','User')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}admin/assets/libs/select2/dist/css/select2.min.css">
@endpush
@section('body')
    <div class="page-wrapper ">
        <div class="page-breadcrumb" style="border-bottom: 2px solid lightgray">
            <div class="row py-3 ">
                <div class="col-5 align-self-center">
                    <h5 class="page-title text-uppercase" style="font-family: 'Bell MT';font-size: 16px"><i class="mdi mdi-checkbox-marked-outline mr-2 "></i> User Module</h5>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"> <a href="{{url('admin/dashboard')}}" class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{url('admin/users')}}" class="text-warning"> Users List </a>
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
                <div class="col-12 mx-auto mt-4">
                    <div class="card">
                        <div class="card-header bg-transparent border-bottom">
                            <i class="fa fa-plus-circle mr-2"></i> Create User Form
                        </div>
                        <div class="card-body">
                            <form action="{{url('admin/users')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2" for="name"> User Name <span class="text-danger"> * </span></label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter user name . . ." />
                                    </div>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2" for="email"> Email <span class="text-danger"> * </span></label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror"  placeholder="Enter user email . . .">
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2" for="password"> Password <span class="text-danger"> * </span></label>
                                    <div class="col-sm-10">
                                        <input  type="password" name="password" class="form-control @error('password') is-invalid @enderror"  placeholder="Enter password . . .">
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2" for="password-confirm"> Confirm Password <span class="text-danger"> * </span> </label>
                                    <div class="col-sm-10">
                                        <input type="password"  name="password_confirmation"  class="form-control @error('password_confirmation') is-invalid @enderror "placeholder="Enter confirm password ....">
                                    </div>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2" for="name"> Mobile </label>
                                    <div class="col-sm-10">
                                        <input type="number" name="mobile" value="{{old('mobile')}}" class="form-control @error('mobile')is-invalid @enderror"  placeholder="Enter user mobile number . . ." />
                                    </div>
                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2" for="role_id"> Role Name <span class="text-danger"> * </span></label>
                                   <div class="col-sm-10">
                                       <select  name="role_id[]"  class="select2 form-control @error('role_id') is-invalid @enderror" multiple="multiple" style="width: 100%">
                                           @foreach($roles as $role)
                                               <option value="{{$role->id}}" {{old('role_id')==$role->id ?'selected' :''}}>{{$role->name}}</option>
                                           @endforeach
                                       </select>
                                       @error('role_id')
                                       <span class="invalid-feedback" role="alert">
                                         <strong>{{$message}}</strong>
                                       </span>
                                       @enderror
                                   </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2" for="image"> Image  </label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror"/>
                                        @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                        <code>[ Only upload jpeg, jpg,webp ]</code>
                                    </div>

                                </div>
                                <div class="form-group mt-lg-4">
                                    <div class="col-sm-10 offset-2">
                                        <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-save mr-1"></i>SAVE</button>
                                        <a href="{{url('admin/users')}}" class="btn btn-outline-danger btn-sm ml-2"><i class="fas fa-arrow-circle-left mr-1"></i>BACK</a>
                                    </div>
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
    <script src="{{asset('/')}}admin/assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="{{asset('/')}}admin/assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="{{asset('/')}}admin/assets/dist/js/pages/forms/select2/select2.init.js"></script>
@endpush

