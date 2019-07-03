@extends('layouts.app2')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Form
            <small>NAS Form</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Form</a></li>
            <li class="active">NAS Form</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
            @include('layouts.messages')
            <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">NAS Form</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    {!! Form::open(['action' => 'NasController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::label('id', 'NAS Id')}}
                            {{Form::number('id', '', ['class' => 'form-control', 'placeholder' => 'NAS Id (Fill with number)'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('name', 'NAS Name')}}
                            {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'NAS Name'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('shortname', 'Shortname')}}
                            {{Form::text('shortname', '', ['class' => 'form-control', 'placeholder' => 'Shortname'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('type', 'Type')}}
                            {{Form::text('type', '', ['class' => 'form-control', 'placeholder' => 'Type'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('secret', 'Secret')}}
                            {{Form::text('secret', '', ['class' => 'form-control', 'placeholder' => 'Secret'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('description', 'Description')}}
                            {{Form::text('description', '', ['class' => 'form-control', 'placeholder' => 'Description'])}}
                        </div>
                        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection