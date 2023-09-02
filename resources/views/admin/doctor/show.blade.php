@extends('layouts.backend.index')
@section('title') {{ $doctor->users->name }} @endsection

@section('content')

<p class="h1 fw-bold fs-1 text-center py-5">
    {{ $doctor->users->name }}<br>
        from
    {{ $doctor->districts->name }}<br>
        in
    {{ $doctor->departments->name }}


</p>

@endsection
