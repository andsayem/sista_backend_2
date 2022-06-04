@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Journal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Journal</li>
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
                <h3 class="card-title">Journal</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>ID</th>
                    <th>Title</th> 
                    <th>Details</th> 
                    <th>User</th> 
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($items as $key => $row)
                  <tr>
                    <td> {{ $key + 1 }} </td>
                    <td> {{ $row->title }}</td>
                    <td> {{ $row->details }}</td>
                    <td> {{ $row->userjoin->name }}</td>
                   
                  </tr>
                 
                  @endforeach
                  </tbody>
                  
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
