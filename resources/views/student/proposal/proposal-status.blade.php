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
            <h6 class="m-0 font-weight-bold text-primary">Proposal Status</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Teacher Name</th>
                        <th>Project Name</th>
                        <th>Category Name</th>
                        <th>Message</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($proposals as $proposal)
                        <tr>
                            <td>{{$proposal->teacher_name}}</td>
                            <td>{{$proposal->project_name}}</td>
                            <td>{{$proposal->category_name}}</td>
                            <td>{{$proposal->message}}</td>
                            <td>
                                @if($proposal->proposal_status==0)
                                    Pending
                                @elseif($proposal->proposal_status==1)
                                    Accepted
                                @else
                                    Cancelled
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
