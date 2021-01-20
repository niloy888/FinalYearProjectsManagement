@extends ('teacher.master')

@section('body')

    <!-- Begin Page Content -->
    {{--<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
--}}

    <!-- DataTales Example -->

    <div style="display: inline-block">
        <form action="{{route('teacher-final-project')}}" method="post"
              class="d-none d-sm-inline-block form-inline mr-auto  my-2 my-md-0 mw-100 navbar-search">
            @csrf
            <div class="input-group">
                <input type="text" id="project_name" name="project_name" class="form-control  border-0 small"
                       placeholder="Project name..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">

                        <i class="fas fa-search fa-sm"></i>

                    </button>
                </div>

            </div>
        </form>
        <form action="{{route('google-search')}}" method="post"
              class="d-none d-sm-inline-block form-inline mr-auto  my-2 my-md-0 mw-100 navbar-search">
            @csrf
            <div class="input-group ml-5">
                <input type="text" name="project_name" class="form-control  border-0 small"
                       placeholder="Google Search..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">

                        <i class="fas fa-search fa-sm"></i>

                    </button>
                </div>

            </div>
        </form>

    </div>

    <div id="bookList" class=""></div>
    {{csrf_field()}}

    <div class="mt-3 card shadow mb-4" style="position: fixed">
        <div class="card-header py-3">


            <h6 class="m-0 font-weight-bold text-primary">Final Projects</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Teacher Name</th>
                        <th>Group ID</th>
                        <th>Category Name</th>
                        <th>Starting Date</th>
                        <th>Ending Date</th>
                        <th>Final Report</th>

                    </tr>
                    </thead>

                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project->project_name}}</td>

                            <td>{{$project->teacher_name}}</td>
                            <td>{{$project->group_id}}</td>
                            <td>{{$project->category_name}}</td>
                            <td>{{$project->created_at}}</td>
                            <td>{{$project->updated_at}}</td>
                            <td><a href="{{route('final-report-view',['id'=>$project->group_id])}}">{{$project->final_report}}</a></td>


                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--</div>--}}
    <!-- /.container-fluid -->

    <script type="text/javascript">
        $(document).ready(function () {

            $('#project_name').keyup(function () {
                var query2 = $(this).val();
                if (query2 != '') {
                    var _token2 = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{route('autocomplete.project')}}",
                        method: "POST",
                        data: {query: query2, _token: _token2},
                        success: function (data) {
                            $('#bookList').fadeIn();
                            $('#bookList').html(data);
                        }
                    });
                }
            });

            $(document).on('click', 'li#teacher', function () {
                $('#project_name').val($(this).text());
                $('#bookList').fadeOut();

            });
        });
    </script>


@endsection


