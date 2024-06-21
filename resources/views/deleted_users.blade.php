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
              <li class="breadcrumb-item active">Data Pengguna yang Dihapus</li>
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
                  <h3 class="card-title">DAFTAR PENGGUNA YANG DIHAPUS</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Photo</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                         @foreach ($data as $d)
                             <tr>
                                 <td>{{ $loop->iteration }}</td>
                                 <td><img src="{{ asset('storage/photo-user/' . $d->image) }}" alt="" width="100"></td>
                                 <td>{{ $d->name }}</td>  
                                 <td>{{ $d->email }}</td>
                                 <td> 
                                  <!-- Tombol untuk memulihkan pengguna -->
                                    <form action="{{ route('admin.users.restore', ['id' => $d->id]) }}" method="POST" style="display:inline;">
                                      @csrf
                                      <button type="submit" class="btn btn-success"><i class="fas fa-undo"></i> Restore</button>
                                  </form>

                                  <!-- Tombol untuk menghapus pengguna secara permanen -->
                                <form action="{{ route('admin.users.permanentDelete', ['id' => $d->id]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Hapus Permanen</button>
                                </form>
                                 </td>
                            </tr> 
                         @endforeach
                    </tbody>
                  </table>
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
    <!-- Script untuk SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if($message = Session::get('berhasil'))
    <script>
      Swal.fire({
        position: "center",
        icon: "success",
        title: "{{ $message }}",
        showConfirmButton: false,
        timer: 3000
      });
    </script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if($message = Session::get('hapus'))
    <script>
      Swal.fire({
        position: "center",
        icon: "success",
        title: "{{ $message }}",
        showConfirmButton: false,
        timer: 3000
      });
    </script>
    @endif
  </div>  
@endsection
