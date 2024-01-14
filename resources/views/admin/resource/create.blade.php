@extends('admin.dashboard.master')
@section('title','Resource')
@push('css')
    <link href="{{asset('/')}}admin/assets/css/bootstrap-tagsinput.css" rel="stylesheet"/>
@endpush
@section('body')
    <div class="page-wrapper ">
        <div class="page-breadcrumb" style="border-bottom: 2px solid lightgray">
            <div class="row py-3 ">
                <div class="col-5 align-self-center">
                    <h5 class="page-title text-uppercase" style="font-family: 'Bell MT';font-size: 16px"><i class="mdi mdi-checkbox-marked-outline mr-2 "></i>Resource</h5>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"> <a href="{{url('Admin/dashboard')}}" class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{route('resources.index')}}" class="text-warning">Resources List</a>
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
                            <i class="fas fa-plus-circle mr-2"></i> Create Resource Form
                        </div>
                        <div class="card-body">
                            <form action="{{url('admin/resources')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                               <div class="form-group">
                                   <label for="name"> Resource Name <span class="text-danger"> * </span>: </label>
                                   <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter permission name . . ." />
                                   @error('name')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{$message}}</strong>
                                   </span>
                                   @enderror
                               </div>
                                <div class="form-group mt-lg-3">
                                    <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-save mr-1"></i>SAVE</button>
                                    <a href="{{url('admin/resources')}}" class="btn btn-outline-danger btn-sm ml-2"><i class="fas fa-arrow-circle-left mr-1"></i>BACK</a>
                                </div>
                            </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
