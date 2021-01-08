@extends ('student.master')

@section('body')

    <!-- Begin Page Content -->
    {{--<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tables</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p>
--}}

    <!-- DataTales Example -->
    <h1 style="text-align: center" class="m-0 font-weight-bold text-danger">Project Deadline:</h1>

    <p style="font-size: 30px;text-align: center" id="demo"></p>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Project Status</h6>
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
                        <th>Status</th>
                        <th>Marks</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($projects as $project)
                        <tr>
                            <td>{{$project->teacher_name}}</td>
                            <td>{{$project->project_name}}</td>
                            <td>{{$project->category_name}}</td>
                            <td>
                                @if($project->project_status==0)
                                    Incomplete
                                @elseif($project->project_status==1)
                                    Completed
                                @else
                                    Dropped
                                @endif
                            </td>
                            <td>{{$project->marks}}</td>
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
        // Set the date we're counting down to

        let countDownDate = new Date("{!! Carbon\Carbon::parse($group_id->deadline)->format('m.d.Y H:i:s') !!}").getTime();


        // Update the count down every 1 second
        let x = setInterval(function() {

            // Get today's date and time
            let now = new Date().getTime();

            // Find the distance between now and the count down date
            let distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            let days = Math.floor(distance / (1000 * 60 * 60 * 24));
            let months = Math.floor(days/30);
            let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML = months+" month || " + days + " days " + hours + " hours "
                + minutes + " minutes " + seconds + " seconds ";

            // If the count down is over, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
        }, 1000);
    </script>

@endsection
