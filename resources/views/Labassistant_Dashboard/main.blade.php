<!-- @extends('layouts.master') -->

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<div class="main">
		<!-- MAIN CONTENT -->
		<div class="main-content">
				<div class="container-fluid">
					<h1>Lab Assistant</h1>
					<br>
					<br>
					<div>
					<form method="post" action="/la/addlabreport" enctype="multipart/form-data">
					{{ csrf_field() }}
  					<div class="form-group">
  					  	<label for="InputField1">Patient Id</label>
  					  	<input type="text" name="id" class="form-control" id="InputField1" placeholder="ID">
  					  	<span>{{$errors->first('id')}}</span>

					</div>
					<div class="form-group">
  					  	<label for="InputField2">Patient Name</label>
  					  	<input type="text" name="name" class="form-control" id="InputField2" placeholder="Patient Name">
  					  	<span>{{$errors->first('name')}}</span>
					</div>

					<div class="form-group">
  					  	<label for="InputField3">Choose File</label><br>
  					  	<input type="file" name="file" class="btn btn-default" id="InputField3" value="Choose">
  					  	<span>{{$errors->first('file')}}</span>
  					  	@if($errors->has('file'))
  					  		<p class="help-block">
  					  			{{$errors->first('file')}}
  					  		</p>
  					  	@endif
  					  	
					</div>
					
					<br>
  					<button type="submit" class="btn btn-default" placeholder="Qualifications">Submit</button>
				</form>
					</div>
				</div>
		</div>
	</div>

</body>
</html>

<!-- @section('content') -->
	<!-- MAIN -->
	
<!-- @endsection -->

<style type="text/css">
	
	.help-block{
		color: red;
	}
</style>