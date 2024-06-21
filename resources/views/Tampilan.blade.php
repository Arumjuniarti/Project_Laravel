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
              <li class="breadcrumb-item active">Data Siswa</li>
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
                <a href="{{ route('User.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">DAFTAR PENGGUNA</h3>
  
                  <div class="card-tools">
                    <form action="{{ route('search') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ request('search') }}">
  
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         @foreach ($data as $d)
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td>{{ $d->name }}</td>  
                                 <td>{{ $d->email }}</td>
                                 <td> 
                                  <a href="{{ route('User.edit', ['id' => $d->id]) }}" class="btn btn-primary"><i class="fas fa-pen"></i>Edit</a>

                                    <a data-toggle="modal" data-target="#modal-hapus{{ $d->id }}" class="btn btn-danger"><i class="fas fa-trash-alt">Hapus</i></a>
                                 </td>
                        
                            </tr> 
                            <div class="modal fade" id="modal-hapus{{ $d->id }}">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title">Konfirasi Hapus Data</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <p>Apakah kamu yakin ingin menghapus data user <b>{{ $d->name }}</b></p>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <form action="{{ route('User.delete', ['id' =>$d->id]) }}" method="POST">
                                      @csrf
                                      @method ('DELETE')
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Ya, Hapus Data</button>
                                    </form>
                                    
                                  </div>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                         @endforeach
                    </tbody>
                  </table>
                 
                  

                  <nav aria-label="Page navigation example">
                    <ul class="pagination">
                      <!-- Tombol Previous -->
                      
                      <li class="page-item{{ $data->onFirstPage() ? ' disabled' : '' }}">
                        <a class="page-link" href="{{ $data->previousPageUrl() }}" aria-label="Previous">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                  
                      <!-- Tombol halaman -->
                      @for ($i = 1; $i <= $data->lastPage(); $i++)
                        <li class="page-item{{ $data->currentPage() == $i ? ' active' : '' }}">
                          <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                        </li>
                      @endfor
                  
                      <!-- Tombol Next -->
                      <li class="page-item{{ $data->hasMorePages() ? '' : ' disabled' }}">
                        <a class="page-link" href="{{ $data->nextPageUrl() }}" aria-label="Next">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                  


                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>  
    
@endsection