@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Product</li>
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
                <h3 class="card-title">Product</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>ID</th>
                    <th>Photo</th> 
                    <th>Title</th> 
                    <th>Details</th> 
                    <th>Price</th> 
                    <th>Offer Price</th> 
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($items as $key => $row)
                  <tr>
                    <td> {{ $key + 1 }} </td>
                    <td> <img src="{{ $row->file }}" ></td>
                    <td> {{ $row->title }}</td>
                    <td> {{ $row->details }}</td>
                    <td> <del> {{ $row->price }}<del></td>
                    <td> {{ $row->price_offer }}</td>
                   
                  </tr>
                 
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Title</th> 
                    <th>Details</th> 
                    <th>Price</th> 
                    <th>Offer Price</th> 
                  </tr>
                  </tfoot>
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
