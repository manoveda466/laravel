@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Student Registration</h1>
    <div class="row pull-right">
        <div class="col-md-12">
            <a href="{{route('studentExport')}}"><button class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Export To Excel</button></a>
        </div>
    </div>
@stop

@section('content')

	@if(Session::has('message'))
	<p id="successMessage" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
	@endif

    <?php
        if(empty($studentDtails))
        {
            $studentDtails = '';
            $student_id         =   '';
            $student_name       =   '';
            $student_phone      =   '';
            $student_email      =   '';
            $student_address    =   '';
            $file_path          =   '';

        }
        else
        {
            foreach ($studentDtails as $key => $value) 
            {
                $student_id         =   $studentDtails[$key]['student_id'];
                $student_name       =   $studentDtails[$key]['student_name'];
                $student_phone      =   $studentDtails[$key]['student_phone'];
                $student_email      =   $studentDtails[$key]['student_email'];
                $student_address    =   $studentDtails[$key]['student_address'];
                $file_path          =   $studentDtails[$key]['file_path'];
            }
        }

    ?>

    <form method="POST" action="{{route('masterInsert')}}" enctype="multipart/form-data">
    	@csrf
        <input type="hidden" name="student_id" class="form-control" value="{{$student_id}}" >
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
    				<label>Name</label>
    				<input type="text" name="student_name" class="form-control" value="{{$student_name}}">
    				@error('student_name')
					    <span style="color: red">{{ $message }}</span>
					@enderror
    			</div>
    		</div>
    		<div class="col-md-6">
    			<div class="form-group">
    				<label>Phone</label>
    				<input type="text" name="student_phone" class="form-control" value="{{$student_phone}}">
    				@error('student_phone')
					    <span style="color: red">{{ $message }}</span>
					@enderror
    			</div>
    		</div>
    	</div>
    	<div class="row">
    		<div class="col-md-6">
    			<div class="form-group">
    				<label>Email</label>
    				<input type="text" name="student_email" class="form-control" value="{{$student_email}}">
    				@error('student_email')
					    <span style="color: red">{{ $message }}</span>
					@enderror
    			</div>
    		</div>
    		<div class="col-md-6">
    			<div class="form-group">
    				<label>Address</label>
    				<textarea name="student_address" class="form-control">{{$student_address}}</textarea>
    				@error('student_address')
					    <span style="color: red">{{ $message }}</span>
					@enderror
    			</div>
    		</div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Choose File</label>
                    <input name="file_path" type="file"  class="form-control" value="">
                    @error('file_path')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div><br>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @if($file_path)
                <img src="{{base_path().'/storage/app/'.$file_path }}" class="css-class" alt="alt text">
                @endif
            </div>
        </div>
    	<div class="row" style="text-align: right;">
    		<div class="col-md-12">
	    		<input type="submit" name="submit" value="Submit" class="btn btn-success">
    		</div>
    	</div>
    </form>
    <table class="table table-bordered data-table" width="100%" ">
        <thead>
            <tr>
                <th>Action</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
             @if($studentRecords)
                @foreach ($studentRecords as $row) 
                    <tr>
                        <td><a href="{{route('masterEdit', $row->student_id)}}"><i class="">Edit</i></a>&nbsp;&nbsp;&nbsp;<a href="{{route('masterDelete', $row->student_id)}}"><i class="">Delete</i></a></td>
                        <td>{{$row->student_phone}}</td>
                        <td>{{$row->student_email}}</td>
                        <td>{{$row->student_name}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4"> No Data Available</td>
                </tr>
            @endif
        </tbody>
    </table>
@stop



<script type="text/javascript">
	setTimeout(function() {
    $('#successMessage').fadeOut('slow');
}, 1500);
</script>


@section('js')
    <script>
        $(document).ready(function () {
            $('.data-table').dataTable();
        });
    </script>
@stop