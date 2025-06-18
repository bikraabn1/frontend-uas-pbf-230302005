# Installation

### Clone Repository ini

```bash

git clone https://github.com/bikraabn1/frontend-uas-pbf-230302005

```

### Install Dependency

```bash

composer install

```
```bash

npm install && npm update

```
### Jalankan

```bash

php artisan serve


```

### Fitur Tambahan Export PDF


Method downloadPDF di BukuController

```php

    public function downloadPDF()
    {
        $response = Http::get("http://localhost:8080/buku");
        $datas = $response->json();

        $pdf = Pdf::loadView('buku-pdf-view', ['datas' =>  $datas])
        ->setPaper('a4', 'portrait');

        return $pdf->download('buku.pdf');   
    }

```

Routes

```php

    Route::get('/buku/download-pdf', [BukuController::class, 'downloadPDF'])->name('download-pdf');

```

View ('buku-pdf-view)

```html

    <!DOCTYPE html>
<html>
<head>
        <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
        <style type="text/css">
                table tr td,
                table tr th{
                        font-size: 9pt;
                }
        </style>
        <center>
                <h5>Membuat Laporan PDF Dengan DOMPDF Laravel</h4>
                <h6><a target="_blank" href="https://www.malasngoding.com/membuat-laporan-…n-dompdf-laravel/">www.malasngoding.com</a></h5>
        </center>

        <table class='table table-bordered'>
                <thead>
                        <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun Terbit</th>
                        </tr>
                </thead>
                <tbody>
                        @php $i=1 @endphp
                        @foreach($datas as $p)
                        <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{$p['judul']}}</td>
                                <td>{{$p['pengarang']}}</td>
                                <td>{{$p['penerbit']}}</td>
                                <td>{{$p['tahun_terbit']}}</td>
                        </tr>
                        @endforeach
                </tbody>
        </table>

</body>
</html>

```
