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
