<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
	<p>{{$msg}}</p>
	
</body>
</html>
<!-- @component('mail::message')
# Welcome

Please Supplie This Drugs.

Drug name :{{ $name }}
Drug Brand:{{ $brand }}
Drug Quantity:{{ $quantity }}

Please suplie before that date {{$date}}
 
}
}

@component('mail::button', ['url' => 'http://127.0.0.1:8000'])
Continue
@endcomponent

@component('mail::panel', ['url' => ''])

@endcomponent
 -->
Thanks,<br>
{{ config('app.name') }}
@endcomponent
