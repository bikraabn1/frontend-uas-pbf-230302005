<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Perpustakaan</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Link
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/">Buku</a></li>
                            <li><a class="dropdown-item" href="/">Peminjaman</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <h2 class="mb-3">Input Data Peminjaman</h2>
        <form method="post" action="{{ route('peminjaman.store') }}">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="peminjam" class="form-label">Nama Peminjam</label>
                <input type="text" name="nama_peminjam" class="form-control" id="peminjam">
            </div>
            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku</label>
                <input type="text" name="judul_buku" class="form-control" id="judul_buku">
            </div>
            <div class="mb-3">
                <label for="tanggal_pinjam" class="form-label">Tanggal Peminjaman</label>
                <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam">
            </div>
            <div class="mb-3">
                <label for="tanggal_kembali" class="form-label">Tanggal Pengembalian</label>
                <input type="date" name="tanggal_kembali" class="form-control" id="tanggal_kembali">
            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <hr class="my-5">

        <h2 class="mb-3">Daftar Peminjaman</h2>
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Peminjam</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Tanggal Peminjaman</th>
                    <th scope="col">Tanggal Pengembalian</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $d)
                <tr>
                    <th scope="row"></th>
                    <td>{{ $d["nama_peminjam"] }}</td>
                    <td>{{ $d["judul_buku"] }}</td>
                    <td>{{ $d["tanggal_pinjam"] }}</td>
                    <td>{{ $d["tanggal_kembali"] }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $d['id'] }}">Update</button>
                        <form 
                            method="post" 
                            action="{{ route('peminjaman.destroy', $d['id']) }}" 
                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                            style="display: inline;"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                
                <div class="modal fade" id="updateModal{{ $d['id'] }}" tabindex="-1" aria-labelledby="updateModalLabel{{ $d['id'] }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateModalLabel{{ $d['id'] }}">Update Data Peminjaman</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('peminjaman.update', $d['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="update_nama_peminjam" class="form-label">Nama Peminjam</label>
                                        <input type="text" name="peminjam" class="form-control" id="update_nama_peminjam" value="{{ $d['nama_peminjam'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_judul" class="form-label">Judul Buku</label>
                                        <input type="text" name="judul_buku" class="form-control" id="update_judul" value="{{ $d['judul_buku'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_pinjam" class="form-label">Tanggal Peminjaman</label>
                                        <input type="date" name="tanggal_pinjam" class="form-control" id="tanggal_pinjam" value="{{ $d['tanggal_pinjam'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="tanggal_kembali" class="form-label">Tanggal Pengembalian</label>
                                        <input type="date" name="tanggal_kembali" class="form-control" id="tanggal_kembali" value="{{ $d['tanggal_kembali'] }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>
</html>