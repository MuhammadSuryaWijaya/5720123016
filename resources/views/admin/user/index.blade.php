@extends('user')

@section('content')

<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Data User</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Data User</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="app-content">
    <div class="container-fluid">

        {{-- Alert Success --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- Tombol Tambah --}}
        <a href="{{ route('user.create') }}" class="btn btn-outline-primary mb-3">
            Create User
        </a>

        {{-- Card Table --}}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List User</h3>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="50">No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th> {{-- ✅ TAMBAHAN --}}
                            <th width="150">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $key => $user)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>

                            {{-- ✅ TAMPILKAN ROLE --}}
                            <td>
                                {{ $user->role->name ?? 'Tidak ada role' }}
                            </td>

                            <td>
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('user.delete', $user->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"
                                        onclick="return confirm('Yakin Hapus Data User Ini?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada data user
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>

@endsection