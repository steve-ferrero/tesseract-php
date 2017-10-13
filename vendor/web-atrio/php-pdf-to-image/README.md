# pdf-to-image
PHP pdf to image converter

## Requirements
You should have [Imagick](http://www.imagemagick.org/script/download.php) and [Ghostscript](http://www.ghostscript.com/) installed.

## Installation

The package can be installed via composer:
``` bash
$ composer require web-atrio/php-pdf-to-image
```

## Usage

Converting a pdf to an image.

```php
$convertor = new WebAtrio\PDFToImage\PDFToImage("test.pdf");
$convertor->convert("test.png");
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.