@extends('teacher.master')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <h3 class="text-center text-success"> {{Session::get('message')}} </h3>
                <form name="availability" action="{{route('submit-availability')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3">Availability:</label>
                        <div class="col-md-3">

                            <select name="availability" class="form-control">
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                            </select>
                        </div>
                    </div>




                    <div class="form-group">
                        <div class="col-md-3 col-md-offset-3" >
                            <input type="submit" class="btn btn-success btn-block" value="Save">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.forms['availability'].elements['availability'].value = '{{ $teacher->availability }}'
    </script>

@endsection
