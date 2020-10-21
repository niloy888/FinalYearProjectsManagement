@extends ('teacher.master')

@section('body')

    <!-- Begin Page Content -->
    {{--<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
--}}

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Details</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td>{{$detail->student_name}}</td>
                            <td>{{$detail->project_name}}</td>
                            <td>{{$detail->short_description}}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-success"
                                   onclick="event.preventDefault();
                                       var check = confirm('Are you sure?');
                                       if(check){
                                       document.getElementById('acceptProposal'+'{{$detail->id}}').submit();
                                       }">Accept</a>

                                <a href="#" class="ml-2 btn btn-sm btn-danger"
                                   onclick="event.preventDefault();
                                       var check = confirm('Are you sure?');
                                       if(check){
                                       document.getElementById('cancelProposal'+'{{$detail->id}}').submit();
                                       }">Cancel</a>

                                <form id="acceptProposal{{$detail->id}}"
                                      action="{{route('accept-proposal')}}" method="post">
                                    @csrf

                                    <input type="hidden" name="id" value="{{$detail->id}}">

                                </form>

                                <form id="cancelProposal{{$detail->id}}"
                                      action="{{route('cancel-proposal')}}" method="post">
                                    @csrf

                                    <input type="hidden" name="id" value="{{$detail->id}}">

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--</div>--}}
    <!-- /.container-fluid -->

@endsection
