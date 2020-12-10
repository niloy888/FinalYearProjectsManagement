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
            <h5 class="font-weight-bold text-primary">{{$teacher->teacher_name}}</h5>

            @if($teacher->teacher_position==1)
            <h6>Professor</h6>
                @elseif($teacher->teacher_position==2)
                <h6>Associate Professor</h6>
            @elseif($teacher->teacher_position==3)
                <h6>Assistant Professor</h6>
            @elseif($teacher->teacher_position==4)
                <h6>Lecturer</h6>
            @endif
            <h6>{{$teacher->teacher_contact_number}}</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">

            <b>Research Interest:</b>
            <br>

            <ul class="mt-2">
                @foreach($categoryList as $list)
                <li>{{$list->category_name}}</li>
                @endforeach
            </ul>


            <b>Ongoing Projects:</b>
            <br>

            <ul class="mt-2">
                @foreach($projects as $project)
                    <li>{{$project->project_name}}</li>
                @endforeach
            </ul>
        </div>


    </div>

    {{--</div>--}}
    <!-- /.container-fluid -->

@endsection
