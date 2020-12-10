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
            <h6 class="m-0 font-weight-bold text-primary">Project Details</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Report</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($details as $detail)
                        <tr>
                            <td>{{$detail->project_name}}</td>
                            <td>{{$detail->short_description}}</td>
                            <td>
                                <a href="{{route('teacher-report-download',['id'=>$detail->id])}}" class="btn btn-sm btn-success">Download</a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm btn-success"
                                   onclick="event.preventDefault();
                                       var check = confirm('Are you sure?');
                                       if(check){
                                       document.getElementById('acceptProposal'+'{{$detail->id}}').submit();
                                       }">Accept</a>

                                <a href="#" class="btn btn-sm btn-danger modalButton"
                                   data-report-id={{$detail->id}}  data-toggle="modal"
                                   data-target="#exampleModal">Reject</a>


                                {{--<a href="#" class="ml-2 btn btn-sm btn-danger"
                                   onclick="event.preventDefault();
                                       var check = confirm('Are you sure?');
                                       if(check){
                                       document.getElementById('cancelProposal'+'{{$detail->id}}').submit();
                                       }">Reject</a>--}}

                                <form id="acceptProposal{{$detail->id}}"
                                      action="{{route('accept-proposal')}}" method="post">
                                    @csrf

                                    <input type="hidden" name="id" value="{{$detail->id}}">

                                </form>

                                {{--<form id="cancelProposal{{$detail->id}}"
                                      action="{{route('cancel-proposal')}}" method="post">
                                    @csrf

                                    <input type="hidden" name="id" value="{{$detail->id}}">

                                </form>--}}


                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{route('cancel-proposal')}}" method="post">
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

                                                    <textarea name="reason" rows="5" cols="50" placeholder="Enter reason"></textarea>

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

    <script>

        $('.modalButton').click(function () {
            var reportId = $(this).attr('data-report-id');
            $("#reportIdInput").val(reportId);

        });


    </script>

@endsection
