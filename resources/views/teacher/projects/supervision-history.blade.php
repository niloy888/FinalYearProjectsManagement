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
            <h6 class="m-0 font-weight-bold text-primary">Supervision History</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Group ID</th>
                        <th>Project Name</th>
                        <th>Category</th>
                        <th>Marks</th>
                        <th>Starting Date</th>
                        <th>Completion Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php($i=1)
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$project->group_id}}</td>
                            <td>{{$project->project_name}}</td>
                            <td>{{$project->category_name}}</td>
                            <td>{{$project->marks}}</td>
                            <td>{{$project->created_at}}</td>
                            @if($project->project_status==1)
                            <td>{{$project->updated_at}}</td>
                                @else
                                <td>Not Completed</td>
                            @endif
                            @if($project->project_status==0)
                                <td>Ongoing</td>
                            @elseif($project->project_status==1)
                                <td>Completed</td>
                            @else
                                <td>Dropped</td>
                            @endif

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
