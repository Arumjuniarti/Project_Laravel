<?php
// Menangani pencarian pengguna
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        // Adjust the search logic to search the users table
        $users = User::where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->paginate(10);
        
        return view('index', compact('users'));
    }