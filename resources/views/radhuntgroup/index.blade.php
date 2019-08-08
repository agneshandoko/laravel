@extends('layouts.app2')
<style>
table, th, td {
    border: 1px solid black;
}

.btn-block {
    display: inline-block !important;
    width: 15% !important;
    /* float: right;
    margin: 20px 0px; */
    margin-bottom: 10px !important;
}
</style>
@section('styles')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"> -->
@endsection

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
    <li><a href="{{url('radgroupcheck')}}"><i class="fa fa-table"></i> <span>Rad Group Check</span></a></li>
    <li><a href="{{url('radgroupreply')}}"><i class="fa fa-table"></i> <span>Rad Group Reply</span></a></li>
    <li class="active"><a href="{{url('radhuntgroup')}}"><i class="fa fa-table"></i> <span>Rad Hunt Group</span></a></li>
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
                        <h3 class="box-title">Rad Hunt Group Table</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <a href="../public/radhuntgroup/create"><button type="button" class="btn btn-block btn-info">Add Rad Hunt Group</button></a>
                        <table class="table table-bordered table-striped" id="datatable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Groupname</th>
                                    <th>Nasipaddress</th>
                                    <th>Nasportid</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Groupname</th>
                                    <th>Nasipaddress</th>
                                    <th>Nasportid</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            </tbody>
                        </table>
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
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
					"url":"<?= route('dataRadHuntGroup') ?>",
					"dataType":"json",
					"type":"POST",
					"data":{"_token":"<?= csrf_token() ?>"}
				},
                "columns": [
                    { "data": "id" },
                    { "data": "groupname" },
                    { "data": "nasipaddress" },
                    { "data": "nasportid" },
                    { "data": "action", "searchable":false,"orderable":false }    
                ]
            });
        });
    </script>
@endsection

