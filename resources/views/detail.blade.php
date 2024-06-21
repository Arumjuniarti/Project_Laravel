@extends('dasboard.layout')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Detail User</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detail User</h3>
              </div>
              
              <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <p>{{ $data->email }}</p>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nama</label>
                    <p>{{ $data->name }}</p>
                </div>
            </div>
            
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Type Rumah</th>
                            <th>Harga Rumah</th>
                            <th>Alamat Rumah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data->rumahs as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->type_rumah }}</td>
                                <td>{{ $item->harga_rumah }}</td>
                                <td>{{ $item->lokasi_rumah }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          
        </div>
       </form>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  
  </div>  
    
@endsection