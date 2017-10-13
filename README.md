# tesseract-php

## Requirements
You should have [Tesseract](https://github.com/tesseract-ocr/tesseract/wiki) installed.

## Installation

The package can be installed via composer:
``` bash
$ composer require web-atrio/tesseract-php
```

## Usage

Read image file or PDF file.
For PDF file the temp property is required.

```php
$tesseract = new TesseractPHP("test.png");
$output = $tesseract->run();
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.