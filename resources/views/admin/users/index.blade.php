@extends('layouts.admin')

@section('title', 'Kelola Users')
@section('sub-title', 'Manajemen Data Customer')

@section('content')
<div class="container-fluid px-4">

    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0 text-primary">Daftar Data Users</h4>

            <a href="{{ route('admin.user.export') }}" class="btn btn-success">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="datatablesSimple" class="table table-bordered align-middle small">
                    <thead class="table-primary">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $i => $u)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.user.show', $u->id) }}" class="btn btn-info btn-sm">
                                        <i data-feather="eye"></i>
                                    </a>

                                    <form action="{{ route('admin.user.delete', $u->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection
