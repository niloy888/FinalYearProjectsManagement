@extends ('student.master')

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
            <h6 class="m-0 font-weight-bold text-primary">My Tasks</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Description</th>
                        <th>Github Link</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php($i=1)
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$task->task_description}}</td>
                            <td><a href="{{$task->github_link}}">{{$task->github_link}}</a></td>
                            <td>{{$task->created_at}}</td>
                            <td>

                          @if($task->task_mark==null)
                              Pending
                              @else
                              Reviewed
                              @endif

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
