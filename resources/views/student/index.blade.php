@extends('layouts.default')

@section('content')
<div class="container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
                <div class="col-sm-5">
					<h2><b>Student</b></h2>
				</div>
				<div class="col-sm-7">
					<a href="{{route('student.create')}}" class="btn btn-primary"><i class="fa fa-user" aria-hidden="true"></i><span>Add New Student</span></a>					
				</div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Profile</th>
                    <th>Name</th>						
					<th>Email</th>
					<th>Mobile</th>
                    <th>Created at</th>
					<th colspan="3">Action</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data))
                @foreach($data as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td><a href="javascript:void(0)">
                        <img src="{{url('/')}}/student_profile/{{$student->image}}" class="avatar" alt="Avatar" width=60px></a></td>
                    <td>{{ucfirst($student->name)}}</td>
                    <td>{{$student->email}}</td>                        
                    <td>{{$student->mobile}}</td>
                    <td>{{$student->created_at->diffForHumans()}}</td>
					<td>
                        <a href="{{route('student.show', $student->id)}}"><i class="fa fa-eye"></i></a>
                        <a href="{{route('student.edit', $student->id)}}" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <form action="{{ route('student.destroy', $student->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                        <a onclick="return confirm('Are you sure?')"  href="{{route('student.destroy', $student->id)}}">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                        </form>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="10" align="center">No Records Found</td>
                </tr>
                @endif
            </tbody>
        </table>
        @if(count($data))
		<div class="clearfix">
             <div class="hint-text">Showing <b>{{ $data->lastItem() }}</b> out of <b>{{ $data->total() }}</b> entries</div>
                {{$data->links("pagination::bootstrap-4")}}
        </div>
        @endif
    </div>
</div>     
@endsection                              		                            