@extends('student.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <h3 class="text-center text-success"> {{Session::get('message')}} </h3>
                <form action="{{route('student-task-submit')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="control-label col-md-3">Description</label>
                        <div class="col-md-6">
                            <input type="hidden" value="{{Session::get('student_id')}}" name="student_id">

                            <textarea rows="5" cols="60" name="task_description"></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">Task Images</label>
                        <div class="col-md-6">
                            <input type="file" multiple name="task_images[]" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Github Link</label>
                        <div class="col-md-6">
                            <input type="url" name="github_link">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3" >
                            <input type="submit" class="btn btn-success btn-block" value="Save">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
