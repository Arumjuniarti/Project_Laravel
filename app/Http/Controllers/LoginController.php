<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Models\PasswordResetToken;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;




class LoginController extends Controller
{
    //
    function index (){
        return view('auth.login');
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function forgot_password_act(Request $request)
    {
        $customMessage = [
            'email.required'    => 'Email tidak boleh kosong',
            'email.email'       => 'Email tidak valid',
            'email.exists'      => 'Email tidak terdaftar di database',
        ];

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], $customMessage);

        $token = Str::random(60);

        PasswordResetToken::updateOrCreate(
            [
                'email' => $request->email
            ],
            [
                'email' => $request->email,
                'token' => $token,
                'created_at' => now(),
            ]
        );

        Mail::to($request->email)->send(new ResetPasswordMail($token));

        return redirect()->route('forgot-password')->with('success', 'Kami telah mengirimkan link reset password ke email anda');
    }
    

    function login_proses(Request $request){
        // Validasi data yang diterima dari form login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Menyiapkan data untuk proses autentikasi
        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];
            
        if (Auth::attempt($data)) {
            // Jika autentikasi berhasil, redirect ke dashboard
            return redirect()->route('admin.dashboard');
        } else {
            // Jika autentikasi gagal, redirect kembali ke halaman login dengan pesan error
            return redirect()->route('login')->with('failed', 'Email atau password Anda salah');
        }
    }
    function logout(){
        
        Auth::logout();
        return redirect()->route('login')->with('succsess','kamu berhasil logout');
    }

     // Fungsi untuk menampilkan form pendaftaran
     public function register_form()
     {
         return view('auth.register');
     }
 

     // Fungsi untuk memproses data pendaftaran
     public function register_act(Request $request)
     {
         $request->validate([
             'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
             'email' => 'required|email|unique:users,email',
             'nama' => 'required|string|max:255',
             'password' => 'required|string|min:8',
         ]);
 
         // Upload photo
         $path = $request->file('photo')->store('photos', 'public');
 
         User::create([
             'photo' => $path,
             'email' => $request->email,
             'name' => $request->nama,
             'password' => Hash::make($request->password),
         ]);
 
         // Redirect ke halaman login dengan pesan sukses
         return redirect()->route('login')->with('success', 'User created successfully! Please login.');
     }
}
