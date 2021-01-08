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
            <h6 class="m-0 font-weight-bold text-primary">Ongoing Projects</h6>
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
                        <th>Category Name</th>
                        <th>Remaining</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @php($i=1)
                    @foreach($projects as $project)
                        <input type="hidden" value="{{$from = \Carbon\Carbon::now()}}">
                        <input type="hidden" value="{{$to = \Carbon\Carbon::parse($project->deadline)}}">
                        <input type="hidden" value="{{$days = $from->diffInDays($to)}}">
                        <input type="hidden" value="{{$months = $from->diffInMonths($to)}}">

                        <tr>



                            <td>{{$i++}}</td>
                            <td>{{$project->group_id}}</td>
                            <td>{{$project->project_name}}</td>
                            <td>{{$project->category_name}}</td>
                            <td>{{$months}} months || {{$days}} days</td>
                            <td>
                                {{--<a href="#" class="btn btn-success modalButton"
                                   data-report-id={{$project->id}}  data-toggle="modal"
                                   data-target="#exampleModal">Completed</a>--}}
                                <a href="#" class="btn btn-danger"
                                   onclick="event.preventDefault();
                                       var check = confirm('Are you sure?');
                                       if(check){
                                       document.getElementById('cancelProject'+'{{$project->id}}').submit();
                                       }">Drop</a>

                                <a href="{{route('project-task',['id'=>$project->group_id])}}" class="btn btn-primary">Tasks</a>
                                @if($project->project_submission==1)
                                <a href="{{route('final-submission',['id'=>$project->group_id])}}" class="btn btn-warning">Submission</a>
                                @endif

                                @if($project->group_change==1)
                                    <a href="{{route('group-change-request',['id'=>$project->group_id])}}" class="btn btn-info">Group Change</a>
                                @endif

                                <form id="cancelProject{{$project->id}}"
                                      action="{{route('cancel-project')}}" method="post">
                                    @csrf

                                    <input type="hidden" name="id" value="{{$project->id}}">

                                </form>

                            </td>
                        </tr>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{route('project-completed')}}" method="post">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Are you sure to
                                                proceed?</h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            @csrf
                                            <input type="hidden" id="reportIdInput" name="id">

                                            <input type="text" name="marks" placeholder="Enter marks here">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--</div>--}}
    <!-- /.container-fluid -->


    <script>

        $('.modalButton').click(function () {
            var reportId = $(this).attr('data-report-id');
            $("#reportIdInput").val(reportId);

        });


    </script>


@endsection
