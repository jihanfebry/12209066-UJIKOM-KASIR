<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginAuth(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|',
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials)){
            $user = Auth::user();

            if($user->role == 'admin'){
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil Login Sebagai admin');
            } elseif($user->role == 'petugas'){
                return redirect()->route('petugas.dashboard')->with('success', 'Berhasil Login Sebagai petugas');
            }
        }

         return redirect()->back()->with('failed', 'Proses login gagal, silahkan coba kembali dengan data yang benar');
    }

    public function index(){
        $users= User::all();
        return view('admin.user.index', compact('users'));
    }

    public function create(){
        return view('admin.user.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3',
            'role' => 'required|in:admin,petugas'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Data pengguna berhasil ditambahkan');
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        $request->validate([
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users,email,'.$user->id,
            'role'=>'required|in:admin,petugas'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
            'role' => $request->role
        ]);
        return redirect()->route('admin.user.index')->with('success', 'Data Pengguna berhasil diupdate');

    }

    public function edit($id){
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function destroy($id){
        $user = User::findorFail($id);
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'Data Pengguna berhasil dihapus!');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('success','anda berhasil logout');
    }

}
