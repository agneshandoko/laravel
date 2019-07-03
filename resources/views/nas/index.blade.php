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
                    @if(count($nasData) > 0)
                      @foreach($nasData as $data)
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
                {{$nasData->links()}}
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

  

<!-- <div class="container"> -->
<?php
  // $link = mysqli_connect("localhost", "root", "", "radius"); 
  // // Check connection
  // if($link === false){
  //     die("ERROR: Could not connect. " . mysqli_connect_error());
  // }
  // $sql = "SELECT * FROM nas";
  // if($result = mysqli_query($link, $sql)){
  //     if(mysqli_num_rows($result) > 0){
  //         while($row = mysqli_fetch_array($result)){
  //             echo "<tr>";
  //                 echo "<td>" . $row['id'] . "</td>";
  //                 echo "<td>" . $row['nasname'] . "</td>";
  //                 echo "<td>" . $row['shortname'] . "</td>";
  //                 echo "<td>" . $row['type'] . "</td>";
  //                 echo "<td>" . $row['ports'] . "</td>";
  //                 echo "<td>" . $row['secret'] . "</td>";
  //                 echo "<td>" . $row['server'] . "</td>";
  //                 echo "<td>" . $row['community'] . "</td>";
  //                 echo "<td>" . $row['description'] . "</td>";
  //             echo "</tr>";
  //         }
  //         // Free result set
  //         mysqli_free_result($result);
  //     } else{
  //         echo "No records matching your query were found.";
  //     }
  // } else{
  //     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  // }
  // mysqli_close($link);
?> 
<!-- </div> -->
@endsection