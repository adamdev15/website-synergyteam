<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function show($id)
    {
        $user = User::with('orders')->findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // optional: jika ingin mencegah delete admin
        // if ($user->role === 'admin') {
        //     return back()->with('error', 'Admin tidak boleh dihapus');
        // }

        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'data-users.xlsx');
    }
}
