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
            <h6 class="m-0 font-weight-bold text-primary">Proposals</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Project Name</th>
                        <th>Category Name</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php($i=1)
                    @foreach($proposals as $proposal)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$proposal->student_name}}</td>
                            <td>{{$proposal->student_id}}</td>
                            <td>{{$proposal->project_name}}</td>
                            <td>{{$proposal->category_name}}</td>
                            <td>{{$proposal->message}}</td>
                            <td>
                                <a href="{{route('teacher-proposal-details',['id'=>$proposal->id])}}"  class="btn btn-success">Details</a>
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
