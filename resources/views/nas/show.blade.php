@extends('layouts.app2')
<style>
table, th, td {
    border: 1px solid black;
}

.btn-block {
    display: inline-block !important;
    width: 10% !important;
    float: right;
    margin: 4px 4px;
}
</style>
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tables
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">NAS tables</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- /.box -->
          <div class="box">
              <div class="box-header">
                <h3 class="box-title">NAS Table</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                  
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nasname</th>
                    <th>Shortname</th>
                    <th>Type</th>
                    <th>Ports</th>
                    <th>Secret</th>
                    <th>Server</th>
                    <th>Community</th>
                    <th>Description</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr>
                        <td>{{$nasData->id}}</td>
                        <td>{{$nasData->nasname}}</td>
                        <td>{{$nasData->shortname}}</td>
                        <td>{{$nasData->type}}</td>
                        <td>{{$nasData->ports}}</td>
                        <td>{{$nasData->secret}}</td>
                        <td>{{$nasData->server}}</td>
                        <td>{{$nasData->community}}</td>
                        <td>{{$nasData->description}}</td>
                    </tr>
                  </tbody>
                </table>
                <br>
                <!-- <a><button type="button" class="btn btn-block btn-danger">Delete</button></a> -->
                <a href="../nas/{{$nasData->id}}/edit"><button type="button" class="btn btn-block btn-info">Update</button></a>
                <a href="../nas"><button type="button" class="btn btn-block btn-default">Back</button></a>
                {!! Form::open(['action' => ['NasController@destroy', $nasData->id], 'method' => 'POST']) !!}
                  {{Form::hidden('_method', 'DELETE')}}
                  {{Form::submit('Delete', ['class' => 'btn btn-block btn-danger'])}}
                {!! Form::close() !!}
              </div>
              <!-- /.box-body -->
            </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection