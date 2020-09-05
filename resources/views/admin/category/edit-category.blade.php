@extends('admin.master')



@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="well">

                <h1 class="text-center text-success"> {{Session::get('message')}} </h1>
                <form action="{{route('update-category')}}" method="post" class="form-horizontal">
                    @csrf
                    <div class="form-group">
                        <label class="control-label col-md-3">Category name</label>
                        <div class="col-md-6">
                            <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}">
                            <input type="hidden" name="id" class="form-control" value="{{$category->id}}">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3">Status</label>
                        <div class="col-md-9 radio">
                            <label>  <input type="radio" {{$category->category_status==1 ? 'checked' : '' }} name="category_status" value="1"> Active </label>
                            <label class="ml-2">  <input type="radio" {{$category->category_status==0 ? 'checked' : '' }} name="category_status" value="0"> Inactive </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3" >
                            <input type="submit" class="btn btn-success btn-block" value="update">
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
