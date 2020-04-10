@extends('layouts.default')
@section('content')
<div class="container">
    <div class="table-wrapper">
          <div class="table-title">
              <div class="row">
                  <div class="col-sm-5">
          <h2><b>Edit Student</b></h2>
        </div>
        <div class="col-sm-7">
          <a href="{{route('student.index')}}" class="btn btn-primary"><i class="fa fa-arrow-left" aria-hidden="true"></i><span>Back</span></a>
        </div>
              </div>
          </div>
          <form method="post" action="{{route('student.update',$data->id)}}" autocomplete="off" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{$data->name}}">
            <div class="text-danger">{{$errors->first('name')}}</div>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email"  value="{{$data->email}}">
            <div class="text-danger">{{$errors->first('email')}}</div>
          </div>
          <div class="form-group">
            <label for="mobile">Mobile:</label>
            <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile" name="mobile" value="{{$data->mobile}}">
            <div class="text-danger">{{$errors->first('mobile')}}</div>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            <div class="text-danger">{{$errors->first('password')}}</div>
          </div>
          <div class="form-group">
            <label for="password">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="{{url('/')}}/student_profile/{{$data->image}}" width="50px">
            <div class="text-danger">{{$errors->first('image')}}</div>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>     
@endsection                                                            