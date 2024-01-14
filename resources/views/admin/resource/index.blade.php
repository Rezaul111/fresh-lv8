@extends('admin.dashboard.master')
@section('title','Resource')
@push('css')
 <link href="{{asset('/')}}admin/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
@endpush
@section('body')
 <div class="page-wrapper">
     <div class="page-breadcrumb">
         <div class="row">
             <div class="col-5 align-self-center">
                 <h5 class="page-title text-uppercase" style="font-family: 'Bell MT';font-size: 16px"><i class="mdi mdi-checkbox-marked-outline mr-2 "></i>Resource</h5>
             </div>
             <div class="col-7 align-self-center">
                 <div class="d-flex align-items-center justify-content-end">
                     <nav aria-label="breadcrumb">
                         <ol class="breadcrumb">
                             <li class="breadcrumb-item">
                                 <a href="{{url('admin/dashboard')}}">Home</a>
                             </li>
                             <li class="breadcrumb-item active" aria-current="page">Resources</li>
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
                         <a class="text-primary text-uppercase" style="font-family: 'Bell MT';font-size: 16px"> <i class="fa fa-angle-double-right mr-2 text-danger"></i> Resources List </a>
                         <a href="{{route('resources.create')}}" class="float-right btn btn-outline-primary btn-sm"><i class="fas fa-plus-circle"></i> Create</a>
                     </div>
                     <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered font-12" id="file_export">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Resource</th>
                                    <th>Inserted By</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($resources as $key=>$resource)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$resource->name ?? ''}}</td>
                                        <td>{{Auth::user()->name ?? ''}}</td>
                                        <td>{{$resource->updated_at->diffforhumans()}}</td>
                                        <td>
                                            <a href="{{route('resources.edit',$resource)}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                                            <form action="{{route('resources.destroy',$resource)}}" method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure ?? want to delete this ..')"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="text-center">
                                        <td  colspan="3"><span class="badge badge-danger"> Sorry ! Data No Found ( : </span></td>
                                    </tr>
                                @endforelse
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
