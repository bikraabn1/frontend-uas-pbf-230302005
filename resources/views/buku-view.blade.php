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
                            <li><a class="dropdown-item" href="/peminjaman">Peminjaman</a></li>
                        </ul>
                    </li>
                </ul>
                <form class="d-flex" action="{{ route('download-pdf') }}">
                    <button class="btn btn-outline-success" type="submit">Download PDF</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        <h2 class="mb-3">Input Data Buku</h2>
        <form method="post" action="{{ route('buku.store') }}">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="judul_buku" class="form-label">Judul Buku</label>
                <input type="text" name="judul" class="form-control" id="judul_buku">
            </div>
            <div class="mb-3">
                <label for="pengarang" class="form-label">Nama Pengarang</label>
                <input type="text" name="pengarang" class="form-control" id="pengarang">
            </div>
            <div class="mb-3">
                <label for="penerbit" class="form-label">Nama Penerbit</label>
                <input type="text" name="penerbit" class="form-control" id="penerbit">
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" id="tahun_terbit">
            </div>
            
            <a href="/buku/download-pdf" type="submit" class="btn btn-primary">Submit</a>
        </form>

        <hr class="my-5">

        <h2 class="mb-3">Daftar Buku</h2>
        <table class="table table-striped-columns">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Pengarang</th>
                    <th scope="col">Penerbit</th>
                    <th scope="col">Tahun Terbit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datas as $d)
                <tr>
                    <th scope="row"></th>
                    <td>{{ $d["judul"] }}</td>
                    <td>{{ $d["pengarang"] }}</td>
                    <td>{{ $d["penerbit"] }}</td>
                    <td>{{ $d["tahun_terbit"] }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#updateModal{{ $d['id'] }}">Update</button>
                        <form 
                            method="post" 
                            action="{{ route('buku.destroy', $d['id']) }}" 
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
                                <h5 class="modal-title" id="updateModalLabel{{ $d['id'] }}">Update Data Buku</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('buku.update', $d['id']) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="update_judul" class="form-label">Judul Buku</label>
                                        <input type="text" name="judul" class="form-control" id="update_judul" value="{{ $d['judul'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_nama_pengarang" class="form-label">Nama Pengarang</label>
                                        <input type="text" name="pengarang" class="form-control" id="update_nama_pengarang" value="{{ $d['pengarang'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_nama_penerbit" class="form-label">Nama Penerbit</label>
                                        <input type="text" name="penerbit" class="form-control" id="update_nama_penerbit" value="{{ $d['penerbit'] }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="update_tahun_terbit" class="form-label">Tahun Terbit</label>
                                        <input type="text" name="tahun_terbit" class="form-control" id="update_tahun_terbit" value="{{ $d['tahun_terbit'] }}">
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