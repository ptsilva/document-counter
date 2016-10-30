# PDF Counter Pages

## This can be used to count the total pages in PDF document

### Instalation
```shell
 composer require ptsilva/pdf-counter-pages
```

Need install [GhostScript](http://ghostscript.com/") also

### Out of the box

```php
$path = '/var/www/html/project/document.php';

$pdf = new \Ptsilva\DocumentCounter\Documents\PDFDocument($path);

$driver = new \Ptsilva\DocumentCounter\PDFGhostScriptCounter('/usr/bin/gs');

$totalPages = $driver->process($pdf);

var_dump($totalPages); // integer

```

### Using Laravel 5

After updating composer, add the ServiceProvider to the providers array in config/app.php
```php
Ptsilva\DocumentCounter\Providers\DocumentCounterServiceProvider::class,
```
Copy the package config to your local config with the publish command:
```shell
php artisan vendor:publish --provider="Ptsilva\DocumentCounter\Providers\DocumentCounterServiceProvider"
```
Just use
```php
$path = '/var/www/html/project/document.php';

$totalPages = app('document-counter')->getTotalPages(new \Ptsilva\DocumentCounter\Documents\PDFDocument($path));

dd($totalPages); // integer
```
Or using Dependency Injection
```php
use Ptsilva\DocumentCounter\Factory\DocumentCounterFactory;
use Ptsilva\DocumentCounter\Documents\PDFDocument;
class Controller
{
    public function index(DocumentCounterFactory $counter)
    {
        $path = '/var/www/html/project/document.php';

        $totalPages = $counter->getTotalPages(new PDFDocument($path));

        dd($totalPages); // integer
    }

}
```
