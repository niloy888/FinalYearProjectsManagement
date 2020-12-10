@extends('student.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <h3 class="text-center text-success"> {{Session::get('message')}} </h3>
                <form action="{{route('submit-proposal')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3">Project name</label>
                        <div class="col-md-6">

                            <input type="hidden" value="{{Session::get('student_id')}}" name="student_id">
                            <input type="hidden" value="{{Session::get('category_id')}}" name="category_id">
                            <input type="hidden" value="{{Session::get('selected_teacher_id')}}" name="teacher_id">
                            <input type="text" name="project_name" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Short Description</label>
                        <div class="col-md-6">
                            <textarea rows="5" cols="60" placeholder="write in short about your project.." name="short_description"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3">Message</label>
                        <div class="col-md-6">
                            <textarea rows="5" cols="60"  name="message"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Proposal Report</label>
                        <div class="col-md-6">
                            <input type="file" name="report" class="form-control">


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
