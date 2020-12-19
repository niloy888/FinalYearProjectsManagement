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
            <h6 class="m-0 font-weight-bold text-primary">Task List</h6>
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
                        <th>Marks</th>
                        <th>Action</th>
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
                            <td>{{$task->task_mark}}</td>

                            <td>

                                @if($task->task_pdf)
                                <a href="{{route('task-pdf-download',['id'=>$task->id])}}" class="btn btn-warning">PDF</a>
                                @endif
                                <a href="{{route('task-images',['id'=>$task->id])}}" class="btn btn-primary">View Images</a>
                                @if($task->task_mark==null)
                                <a href="#" class="btn btn-success modalButton"
                                   data-report-id={{$task->id}}  data-toggle="modal"
                                   data-target="#exampleModal">Give Mark</a>

                                    @endif

                            </td>
                        </tr>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{route('task-mark')}}" method="post">
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

                                            <input type="text" name="task_mark" placeholder="Enter marks here">
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
