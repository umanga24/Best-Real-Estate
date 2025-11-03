@extends('layouts.admin')
@section('page_title') All Segments @endsection
@section('styles')

<link href="{{asset('/assets/admin/vendors/DataTables/datatables.min.css')}}" rel="stylesheet" />
@endsection
@section('content')

<div class="page-heading">
    <h1 class="page-title">Areas</h1>
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('home')}}"><i class="la la-home font-20"></i> Dashboard</a>
        </li>
        <li class="breadcrumb-item"> All Areas</li>
    </ol>
    @include('admin.section.notifications')
</div>
<div class="page-content fade-in-up">
    <div class="ibox">
        <div class="ibox-head">
            <div class="ibox-title">All Areas</div>
            <div>
                <a class="btn btn-info btn-md" href="{{route('area.create')}}">New Area</a>
            </div>
        </div>


        <div class="ibox-body">
            <table class="table table-striped table-bordered table-hover" id="example-table" cellspacing="0" width="100%">
                <thead>
                    <tr class="border-0">
                        <th>SN</th>

                        <th>Name</th>
                        <th>Area</th>


                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if( isset($areas))

                    @foreach($areas as $key => $area)
                    <tr class='clickable-row' data-href="">

                        <td>{{ $key+1}}</td>

                        <td>{{ $area->name}}</td>
                        <td>{{ $area->city->name }}</td>
                        <td>
                            <ul class="action_list">
                                <li>
                                    <a href="{{route('area.edit', $area->id)}}" data- class="btn btn-info btn-md"><i class="fa fa-edit"></i></a>

                                </li>

                                <li>
                                    <form action="" method="post">
                                        @csrf()
                                        @method('DELETE')
                                        <button onclick="return confirm('Are you sure you want to delete this Segment?')" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </li>

                            </ul>

                        </td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="8">
                            You do not have any Segment yet.
                        </td>
                    </tr>
                    @endif



                </tbody>

            </table>
        </div>
    </div>

</div>

@endsection
@section('scripts')
<script src="{{asset('/assets/admin/vendors/DataTables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('/assets/admin/js/sweetalert.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#example-table').DataTable({
            pageLength: 25,
        });
    })
</script>
<script>
    function FailedResponseFromDatabase(message) {
        html_error = "";
        $.each(message, function(index, message) {
            html_error += '<p class ="error_message text-left"> <span class="fa fa-times"></span> ' + message + '</p>';
        });
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            html: html_error,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }

    function DataSuccessInDatabase(message) {
        Swal.fire({
            // position: 'top-end',
            type: 'success',
            title: 'Done',
            html: message,
            confirmButtonText: 'Close',
            timer: 10000
        });
    }
</script>
@endsection