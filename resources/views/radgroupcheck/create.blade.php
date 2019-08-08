@extends('layouts.app2')

@section('sidebars')
    <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>NAS</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="{{url('nas')}}"><i class="fa fa-circle-o"></i> NAS tables</a></li>
            <li><a href="{{url('nastable')}}"><i class="fa fa-circle-o"></i> NAS Data tables</a></li>
        </ul>
    </li>
    <li><a href="{{url('radacct')}}"><i class="fa fa-table"></i> <span>Rad Acct</span></a></li>
    <li><a href="{{url('radcheck')}}"><i class="fa fa-table"></i> <span></span>Rad Check</a></li>
    <li class="active"><a href="{{url('radgroupcheck')}}"><i class="fa fa-table"></i> <span>Rad Group Check</span></a></li>
    <li><a href="{{url('radgroupreply')}}"><i class="fa fa-table"></i> <span>Rad Group Reply</span></a></li>
    <li><a href="{{url('radhuntgroup')}}"><i class="fa fa-table"></i> <span>Rad Hunt Group</span></a></li>
    <li><a href="{{url('radippool')}}"><i class="fa fa-table"></i> <span>Rad Ip Pool</span></a></li>
    <li><a href="{{url('radpostauth')}}"><i class="fa fa-table"></i> <span>Rad Post Auth</span></a></li>
    <li><a href="{{url('radreply')}}"><i class="fa fa-table"></i> <span>Rad Reply</span></a></li>
    <li><a href="{{url('radusergroup')}}"><i class="fa fa-table"></i> <span>Rad User Group</span></a></li>
@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Form
            <small>Rad Group Check Form</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Form</a></li>
            <li class="active">Rad Group Check Form</li>
        </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
            @include('layouts.messages')
            <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Rad Group Check Form</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    {!! Form::open(['action' => 'RadGroupCheckController@store', 'method' => 'POST']) !!}
                        <div class="form-group">
                            {{Form::label('id', 'Rad Group Check Id')}}
                            {{Form::number('id', '', ['class' => 'form-control', 'placeholder' => 'Rad Group Check Id (Fill with number)'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('groupname', 'Rad Group Check Username')}}
                            {{Form::text('groupname', '', ['class' => 'form-control', 'placeholder' => 'Rad Group Check Username'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('attribute', 'Attribute')}}
                            {{Form::text('attribute', '', ['class' => 'form-control', 'placeholder' => 'Attribute'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('op', 'Op')}}
                            {{Form::text('op', '', ['class' => 'form-control', 'placeholder' => 'Op'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('value', 'Value')}}
                            {{Form::text('value', '', ['class' => 'form-control', 'placeholder' => 'Value'])}}
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