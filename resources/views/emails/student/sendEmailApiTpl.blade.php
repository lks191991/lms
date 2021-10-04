@extends('emails.layout')
@section('message')
<body>
{{$data->message,""}}
@endsection