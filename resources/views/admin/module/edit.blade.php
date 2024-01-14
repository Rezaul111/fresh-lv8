@extends('admin.dashboard.master')
@section('title','Module')
@section('body')
    <div class="page-wrapper ">
        <div class="page-breadcrumb" style="border-bottom: 2px solid lightgray">
            <div class="row py-3 ">
                <div class="col-5 align-self-center">
                    <h5 class="page-title text-uppercase" style="font-family: 'Bell MT';font-size: 16px"><i class="mdi mdi-checkbox-marked-outline mr-2 "></i>Module</h5>
                </div>
                <div class="col-7 align-self-center">
                    <div class="d-flex align-items-center justify-content-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"> <a href="{{url('admin/dashboard')}}" class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <a href="{{route('modules.index')}}" class="text-warning">Modules List</a>
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
                            <i class="fa fa-plus-circle mr-2"></i> Edit Module Form
                        </div>
                        <div class="card-body">
                            <form action="{{ url('admin/modules',$module) }}" method="POST" enctype="multipart/form-data">
                                @csrf @method('PUT')
                                <div class="form-group">
                                    <label for="name">Module Name :</label>
                                    <input type="text" name="name" value="{{$module->name ?? ''}}" class="form-control @error('name') is-invalid @enderror"  placeholder="Enter module name . . ." />
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group mt-lg-5">
                                    <button type="submit" class="btn btn-outline-primary btn-sm"><i class="fas fa-arrow-alt-circle-up mr-1"></i>UPDATE</button>
                                    <a href="{{route('modules.index')}}" class="btn btn-outline-danger ml-2 btn-sm"><i class="fas fa-arrow-circle-left mr-1"></i>BACK</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

