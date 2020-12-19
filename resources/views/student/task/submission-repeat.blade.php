@extends ('student.master')

@section('body')


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Project Submission Status</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <p>{{$student->repeat_reason}}</p>
            </div>
        </div>
    </div>



@endsection
