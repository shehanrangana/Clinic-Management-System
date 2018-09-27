<!-- @extends('layouts.master') --> -->
<!-- @section('title', 'LabAssisatantRoll') -->
<!-- @section('content') -->
<!DOCTYPE html>
<html>
<title>Clinic-Management-System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<body>

	<div class="main">
		<!-- MAIN CONTENT -->
		<div class="main-content">
				<div class="container-fluid">
					
  						

 				 			<table class="w3-table-all w3-hoverable">
    							<thead>
      								<tr class="w3-light-grey">
        								<th>Patient Id</th>
        								<th>Patient Name</th>
        								<th>File</th>
        								<th>Download</th>
        
      								</tr>
    							</thead>

    						@foreach($download as $down)
    							<tr>
     								<td>{{$down->id}}</td>
      								<td>{{$down->name}}</td>
      								<td>{{$down->file}}</td>
      								
      								<td>
      									<a href="download/{{$down->file}}" download = "{{$down->file}}">
      									<button type="button" class="btn btn-primary">
      									<span class = "glyphicon glyphicon-download">
      				
      									</span>Download
      									</button>
      									</a>
      								</td>
      
    							</tr>
    						@endforeach
    
  							</table>
					
				</div>
		</div>
	</div>


<!-- @endsection -->
</body>
</html>