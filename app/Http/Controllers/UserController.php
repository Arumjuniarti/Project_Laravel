<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function dashboard()
    {
        return view('dashboard');
    }

    // Menampilkan semua daftar pengguna
    public function index(Request $request)
    {
        // Mengambil data users dengan pagination, 10 data per halaman
        $data = User::paginate(10);

        // Mengirim data ke view 'index'
        return view('index', compact('data'));
    }

    public function asset(Request $request)
    {
        // Mengambil data users dengan pagination, 10 data per halaman
        $data = User::paginate(10);

        // Mengirim data ke view 'index'
        return view('asset', compact('data'));
    }

    // Menampilkan formulir untuk pengguna baru
    public function create()
    {
        return view('create');
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
{
    // dd($request->all());
    $validator = Validator::make($request->all(), [
        'photo'    => 'required|mimes:png,jpg,jpeg|max:2048',
        'email'    => 'required|email',
        'nama'     => [
            'required',
            // Validasi nama harus terdiri dari minimal 8 karakter yang terdiri dari huruf dan angka
            'regex:/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z\d]{8,}$/'
        ],
        'password' => 'required'
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withInput()->withErrors($validator);
    }

    // Mengambil file foto
    $photo = $request->file('photo');
    $filename = date('Y-m-d') . '_' . $photo->getClientOriginalName();
    $path = 'photo-user/' . $filename;

    // Menyimpan foto ke storage
    Storage::disk('public')->put($path, file_get_contents($photo));

    // Membuat user
    User::create([
        'email'    => $request->email,
        'name'     => $request->nama,
        'password' => Hash::make($request->password),
        'image'    => $filename // Kolom 'image' di tabel users untuk menyimpan nama file foto
    ]);

    return redirect()->route('admin.index');
}


    // CRUD untuk pengeditan data pengguna
    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('edit', compact('data'));
    }

    //eloquend one to many
    public function detail($id)
    {
        $data = User::findOrFail($id);
        return view('detail', compact('data'));
    }

    // Memperbarui data pengguna
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'nama'     => 'required',
            'password' => 'nullable'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $data = [
            'email' => $request->email,
            'name'  => $request->nama,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::findOrFail($id)->update($data);

        return redirect()->route('admin.index');
    }

    // Menghapus data pengguna dari database berdasarkan ID
    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index');
    }

    // Menangani pencarian pengguna
    public function search(Request $request)
    {
        $query = User::query();
        
        // Filter berdasarkan search
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%');
        }

        // Pagination
        $data = $query->paginate(10);

        // Mengirim data users ke view index
        return view('admin.index', compact('data'))->with('request', $request);
    }

    public function deletedUsers()
    {
        $data = User::onlyTrashed()->paginate(10); // Sesuaikan dengan kebutuhan paginasi Anda
        return view('deleted_users', compact('data'));
    }
    public function restore($id)
    {
    // Cari data pengguna yang dihapus berdasarkan ID
        $user = User::onlyTrashed()->findOrFail($id);
    
    // Lakukan pemulihan data
        $user->restore();

    // Redirect ke halaman sebelumnya atau ke halaman lain yang diinginkan
         return redirect()->back()->with('berhasil', 'Data pengguna telah berhasil dipulihkan.');
    }

    public function permanentDelete($id)
    {
    // Temukan data pengguna yang dihapus berdasarkan ID
        $user = User::onlyTrashed()->findOrFail($id);
    
    // Hapus pengguna secara permanen
         $user->forceDelete();

    // Redirect ke halaman sebelumnya atau ke halaman lain yang diinginkan
        return redirect()->back()->with('hapus', 'Data pengguna telah berhasil dihapus secara permanen.');
    }
   

}
