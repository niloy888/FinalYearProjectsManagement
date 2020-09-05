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
            <h6 class="m-0 font-weight-bold text-primary">Categories</h6>
            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
        </div>
        <div class="card-body">
            <form action="{{route('teacher-category-add')}}" method="post">
                @csrf
                <ul>

                    @foreach($categories as $category)

                                <li style="list-style-type: none" class="mb-2"><input type="checkbox"
                                                                                      name="category_id[]"
                                                                                      value="{{$category->id}}"> {{$category->category_name}}
                                </li>


                    @endforeach
                </ul>

                <input type="hidden" name="teacher_id" value="{{Session::get('teacher_id')}}">
                <input type="submit" class="btn btn-primary ml-5" value="Submit">
            </form>

        </div>
    </div>

    {{--</div>--}}
    <!-- /.container-fluid -->

@endsection
