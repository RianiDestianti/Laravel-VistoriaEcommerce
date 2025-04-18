<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow-sm p-4">
        <h3 class="text-center text-primary">👋 Halo, Admin!</h3>
        <p class="text-center text-muted">Silakan kelola produk dan pengguna di bawah ini.</p>

        <h4 class="mt-4">🔧 Manajemen Pengguna</h4>
        <div class="d-grid gap-2">
            <a href="{{ route('admin.loggedin_users') }}" class="btn btn-info">👀 Lihat Pengguna</a>
            <a href="{{ route('admin.block_user') }}" class="btn btn-warning">🚫 Blokir Pengguna</a>
            <a href="{{ route('admin.delete_user') }}" class="btn btn-danger">🗑 Hapus Pengguna</a>
        </div>

        @if(isset($users) && $users->count() > 0)
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->is_blocked == 1)
                            <span class="text-danger">Diblokir hingga {{ $user->blocked_until ?? 'selamanya' }}</span>
                        @else
                            <span class="text-success">Aktif</span>
                        @endif
                    </td>
                    <td>
                        <form action="{{ route('admin.toggleBlock', $user->id) }}" method="POST">
                            @csrf
                            <label for="blocked_until_{{ $user->id }}">Durasi Blokir (hari):</label>
                            <input type="number" id="blocked_until_{{ $user->id }}" name="blocked_until" min="1" placeholder="Opsional">
                            <button type="submit" class="btn btn-danger">
                                {{ $user->is_blocked == 1 ? 'Buka Blokir' : 'Blokir' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-muted mt-3">Tidak ada pengguna yang terdaftar.</p>
        @endif
        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
