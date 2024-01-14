@extends('admin.dashboard.master')
@section('title','User')
@push('css')
 <link href="{{asset('/')}}admin/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endpush
@section('body')
 <div class="page-wrapper">
     <div class="page-breadcrumb">
         <div class="row">
             <div class="col-5 align-self-center">
                 <h5 class="page-title text-uppercase" style="font-family: 'Bell MT';font-size: 16px"><i class="mdi mdi-checkbox-marked-outline mr-2 "></i>Users Module</h5>
             </div>
             <div class="col-7 align-self-center">
                 <div class="d-flex align-items-center justify-content-end">
                     <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item">
                                 <a href="">Home</a>
                             </li>
                             <li class="breadcrumb-item active" aria-current="page">Users</li>
                         </ol>
                     </nav>
                 </div>
             </div>
         </div>
     </div>
     <div class="container-fluid">
         <div class="row">
             <div class="col-12">
                 <div class="card p-3">
                     <div class="card-text ">
                         <a class="text-primary text-uppercase" style="font-family: 'Bell MT';font-size: 16px"> <i class="fa fa-angle-double-right mr-2 text-danger"></i> Users List </a>
                         <a href="{{route('users.create')}}" class="float-right btn btn-outline-primary btn-sm"><i class="fas fa-plus-circle"></i> Create</a>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="file_export">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($users as $key=>$user)

                                  <tr>
                                      <td>{{$key+1}}</td>
                                      <td>{{$user->name ?? ''}}</td>
                                      <td>{{$user->email ?? ''}}</td>
                                      <td>
                                          @forelse($user->roles as $role)
                                              <span class="badge badge-secondary badge-pill"> {{$role->name.'' ??''}}</span>
                                          @empty
                                              <span class="badge badge-danger"> Sorry ! Role Not Found ( : </span>
                                          @endforelse
                                      </td>
                                      <td><img src="{{asset($user->image??'')}}" height="50" width="50"/></td>
                                      <td> <strong class="{{$user->status == 1 ? 'text-primary':'text-danger'}}">{{$user->status == 1 ? 'active' :'inactive'}} </strong></td>
                                      <td>
                                          @if($user->status == 1)
                                              <a href="{{url('admin/user-status',$user)}}" class="btn btn-sm btn-outline-info" title="status"><i class="fa fa-arrow-alt-circle-up"></i></a>
                                          @else
                                              <a href="{{url('admin/user-status',$user)}}" class="btn btn-sm btn-outline-danger" title="status"><i class="fa fa-arrow-alt-circle-down"></i></a>
                                          @endif
                                           <a href="{{route('users.edit',$user)}}" class="btn  btn-sm btn-outline-primary" title="edit"><i class="fas fa-edit"></i></a>
                                             <form action="{{route('users.destroy',$user)}}" method="POST" class="d-inline">
                                                 @csrf @method('DELETE')
                                                 <button type="submit" class="btn  btn-sm btn-outline-danger" title="delete" onclick="return confirm('Are you sure ?? want to delete this ...')"><i class="fas fa-trash"></i></button>
                                           </form>
                                      </td>
                                  </tr>

                                @endforeach

                                {{--@foreach($roles as $key=>$role)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$role->name ?? ''}}</td>
                                        <td>{{$role->slug ?? ''}}</td>
                                        <td>
                                            <strong class="{{$role->status == 1 ? 'text-success' : 'text-danger'}}">{{$role->status == 1 ? 'active':'inactive'}}</strong>
                                        </td>

                                        <td>
                                            @if($role->status == 1)
                                                <a href="{{url('admin/role-status',$role)}}" class="btn btn-sm btn-outline-info" title="status"><i class="fa fa-arrow-alt-circle-up"></i></a>
                                            @else
                                                <a href="{{url('admin/role-status',$role)}}" class="btn btn-sm btn-outline-danger" title="status"><i class="fa fa-arrow-alt-circle-down "></i></a>
                                            @endif
                                            <a href="{{route('roles.edit',$role)}}" class="btn  btn-sm btn-outline-primary" title="edit"><i class="fas fa-edit"></i></a>

                                            <form action="{{route('roles.destroy',$role)}}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn  btn-sm btn-outline-danger" title="delete" onclick="return confirm('Are you sure ?? want to delete this ...')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>

                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
@endsection

@push('js')
    <!--js data tables-->
    <script src="{{asset('/')}}admin/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="{{asset('/')}}admin/assets/cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('/')}}admin/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js"></script>
    <script src="{{asset('/')}}admin/assets/cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="{{asset('/')}}admin/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js"></script>
    <script src="{{asset('/')}}admin/assets/cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js"></script>
    <script src="{{asset('/')}}admin/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
    <script src="{{asset('/')}}admin/assets/cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
    <script src="{{asset('/')}}admin/assets/dist/js/pages/datatable/datatable-advanced.init.js"></script>
    <!--js data tables-->
@endpush
