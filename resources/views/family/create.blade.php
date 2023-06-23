@extends('template')

@section('content')
    <div class="container">
        <div class="col-sm-12">
            {{ method_field('post') }}
            {!! Form::open(['autocomplete'=> 'off','method' => 'POST','route' => ['families-store'], 'class'=> 'row g-3 submit-form needs-validation','role' => 'form', 'novalidate', 'enctype' => 'multipart/form-data'])  !!}
            {{ csrf_field() }}
            @include('family.form')
            {!! Form::close() !!}
        </div>
    </div>
@endsection();