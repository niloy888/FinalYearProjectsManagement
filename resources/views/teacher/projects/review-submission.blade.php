@extends ('teacher.master')

@section('body')


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Review Project Submission</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Group ID</th>
                        <th>Project Folder</th>
                        <th>Github Link</th>
                        <th>Final Report</th>
                        <th>Submission Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{$submission->group_id}}</td>
                            <td><a href="{{route('project-folder-download',['id'=>$submission->id])}}">{{$submission->project_folder}}</a></td>
                            <td>{{$submission->github_link}}</td>
                            <td><a href="{{route('final-report-download',['id'=>$submission->id])}}">{{$submission->final_report}}</a></td>
                            <<td>{{$submission->created_at}}</td>
                            <td>
                                <a href="#" class="btn btn-success modalButton"
                                   data-report-id={{$submission->id}}  data-toggle="modal"
                                   data-target="#exampleModal">Give Marks</a>
                            </td>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <form action="{{route('final-report-mark')}}" method="post">
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

                                                <input type="text" name="report_marks" placeholder="Enter marks here">
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



                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>

        $('.modalButton').click(function () {
            var reportId = $(this).attr('data-report-id');
            $("#reportIdInput").val(reportId);

        });


    </script>

@endsection
