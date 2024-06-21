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
              <li class="breadcrumb-item active">Data User</li>
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
                  <h3 class="card-title">DATA PENGGUNA YANG MEMILIKI ASET</h3>
  
                  <div class="card-tools">
                    <form action="{{ route('admin.search') }}" method="GET">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="search" class="form-control float-right" placeholder="Cari" value="{{ request('search') }}">
  
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
                        <th>Photo</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Asset</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                         @foreach ($data as $d)
                         {{-- @php
                             $id = $d->id;
                             $ktp = App\Models\Ktp::Where('user-id', $id)->first();
                         @endphp --}}
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td><img src="{{ asset('storage/photo-user/' . $d->image) }}" alt="" width="100"></td>
                                 <td>{{$d->ktp->nik ?? ''}}</td>
                                 <td>{{ $d->name }}</td>  
                                 <td>
                                    <ul>
                                        @foreach ($d->assets as $asset )
                                            <li>{{$asset->nama_asset}}</li>
                                            
                                        @endforeach
                                    </ul>
                                 </td>
                                 
                                
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