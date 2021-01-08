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
            <h6 class="m-0 font-weight-bold text-primary">Proposal Status</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <div class="d-flex justify-content-end mb-2">

                </div>

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Group ID</th>
                        <th>Batch</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{$student->student_name}}</td>
                            <td>{{$student->student_id}}</td>
                            <td>{{$student->group_id}}</td>
                            <td>{{$student->batch}}</td>
                            <td>{{$student->student_email}}</td>
                            <td>{{$student->student_contact_number}}</td>
                            <td>
                                <a class="btn btn-danger" href="{{route('remove-student',['id'=>$student->id])}}">Remove</a>
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
