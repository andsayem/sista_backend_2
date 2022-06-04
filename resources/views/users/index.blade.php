@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>SI</th> 
                    <th>ID</th> 
                    <th>User</th> 
                    <th>Email</th> 
                    <th>Description</th> 
                    <th>Joining Date</th> 
                    <th>Age Range</th> 
                    <th>Gender</th> 
                    <th>Zip Code</th> 
                 
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($items as $key => $row)
                  <tr>
                    <td> {{ $key + 1 }} </td>
                    <td> {{ $row->id  }} </td>
                    <td> {{ $row->name }}</td>
                    <td> {{ $row->email }}</td>
                    <td> {{ $row->description }}</td>
                    <td> {{  date("M j(D), Y, g:i a", strtotime($row->created_at)) }}</td>
                    <td> {{ $row->age_range  }}</td>
                    <td> {{ $row->gender  }}</td>
                    <td> {{ $row->zip_code  }}</td>
                    
                   
                  </tr>
                 
                  @endforeach
                  </tbody>
                  <!-- <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Caption</th> 
                    <th>User</th> 
                    <th>Cat Name</th> 
                  </tr>
                  </tfoot> -->
                </table>
               
              </div>
              <div class="d-flex justify-content-center">
                    {!! $items->links() !!}
                </div>
                <br>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
 
  <!-- /.content-wrapper -->

@endsection
