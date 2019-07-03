@extends('layouts.app2')
<style>
table, th, td {
    border: 1px solid black;
}

.btn-block {
    display: inline-block !important;
    width: 15% !important;
    float: right;
    margin: 20px 0px;
}
</style>
@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
@endsection

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
            <li class="active">Data tables</li>
        </ol>
    </section>

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
                        <table class="table table-bordered table-striped" id="datatable">
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
                                @if(count($nas) > 0)
                                @foreach($nas as $data)
                                    <tr>
                                    <td>{{$data->id}}</td>
                                    <td><a href="../public/nas/{{$data->id}}">{{$data->nasname}}</a></td>
                                    <td>{{$data->shortname}}</td>
                                    <td>{{$data->type}}</td>
                                    <td>{{$data->ports}}</td>
                                    <td>{{$data->secret}}</td>
                                    <td>{{$data->server}}</td>
                                    <td>{{$data->community}}</td>
                                    <td>{{$data->description}}</td>
                                    </tr>
                                @endforeach
                                @else
                                    <p>No Nas found</p>
                                @endif
                            </tbody>
                        </table>
                        <a href="../public/nas/create"><button type="button" class="btn btn-block btn-info">Add NAS Data</button></a>
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

@section('javascripts')
    <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready( function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection

