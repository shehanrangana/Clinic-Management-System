@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div>
        <profile></profile>
    </div>
@endsection

<script>
    window.auth_user = {!! $user !!}; // Pass logged user data to vue component 
</script>