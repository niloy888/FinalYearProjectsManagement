@extends ('student.master')

@section('body')


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Project Submission Status</h6>
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
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($status as $s)
                        <tr>
                            <td>{{$s->group_id}}</td>
                            <td><a href="{{route('project-folder-download',['id'=>$s->id])}}">{{$s->project_folder}}</a></td>
                            <td>{{$s->github_link}}</td>
                            <td><a href="{{route('final-report-download',['id'=>$s->id])}}">{{$s->final_report}}</a></td>
                            <td>{{$s->created_at}}</td>
                            <td>
                                @if($s->status==0)
                                    Pending
                                @elseif($s->status==1)
                                    Accepted
                                @else
                                    Repeated <a href="{{route('submission-repeat-reason',['id'=>$s->id])}}" class="btn btn-warning">Reason</a>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



@endsection
