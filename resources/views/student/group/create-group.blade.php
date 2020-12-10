@extends('student.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <h3 class="text-center text-success"> {{Session::get('message')}} </h3>
                <form action="{{route('submit-group')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label class="control-label col-md-3">Group Name</label>
                        <div class="col-md-6">


                            <input type="text" name="group_name" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3">Student Id</label>
                        <div class="col-md-6">


                            <input type="number" name="student_id_1" id="student_id_1" class="form-control" >
                        </div>

                        <div class="col-md-6 mt-2" >
                            <button id="btn1">Add Student</button>
                        </div>

                    </div>

                    <div class="form-group">
                        <label style="display: none" id="label2" class="control-label col-md-3">Student Id</label>
                        <div class="col-md-6">


                            <input style="display: none" type="number" name="student_id_2" id="student_id_2" class="form-control" >

                        </div>

                        <div class="col-md-6 mt-2" >
                            <button style="display: none" id="btn2">Add Student</button>
                        </div>

                    </div>

                    <div class="form-group">
                        <label style="display: none" id="label3" class="control-label col-md-3">Student Id</label>

                        <div class="col-md-6">
                            <input style="display: none" type="number" name="student_id_3" id="student_id_3" class="form-control" >
                        </div>

                        <div class="col-md-6 mt-2" >
                            <button style="display: none" id="btn3">Add Student</button>
                            <p style="display: none; color: red" id="p1">*maximum 3 students</p>

                        </div>
                    </div>



                    <div class="form-group">
                        <label class="control-label col-md-3">Batch</label>
                        <div class="col-md-6">

                            <input type="hidden" value="{{Session::get('student_id')}}" name="student_id">

                            <input type="number" name="batch" class="form-control" >
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

    <script>
        $(document).ready(function(){
            $("#btn1").click(function(event){

                event.preventDefault();
                $("#label2").show();
                $("#btn2").show();
                $("#student_id_2").show();
                $("#btn1").hide();

            });

            $("#btn2").click(function(event){

                event.preventDefault();
                $("#label3").show();
                $("#btn3").show();
                $("#student_id_3").show();
                $("#btn2").hide();

            });

            $("#btn3").click(function(event){

                event.preventDefault();
                $("#p1").show();


            });

        });


    </script>

@endsection
