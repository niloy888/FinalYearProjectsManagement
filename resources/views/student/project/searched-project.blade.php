@extends ('student.master')

@section('body')

    <!-- Begin Page Content -->
    {{--<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
--}}

    <!-- DataTales Example -->



    <div class="mt-3 card shadow mb-4" style="position: fixed">
        <div class="card-header py-3">





            <h6 class="m-0 font-weight-bold text-primary">Final Project</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Teacher Name</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Category Name</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project->project_name}}</td>

                            <td>{{$project->teacher_name}}</td>
                            <td>{{$project->student_name}}</td>
                            <td>{{$project->student_id}}</td>
                            <td>{{$project->category_name}}</td>
                            <td>{{$project->created_at}}</td>
                            <td>{{$project->updated_at}}</td>


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


