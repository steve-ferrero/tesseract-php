<?php

namespace WebAtrio\PDFToImage;

use WebAtrio\PDFToImage\Exceptions\PDFNotFound;
use WebAtrio\PDFToImage\Exceptions\InvalidFormat;

class PDFToImage {

    private $pdfFile;
    private $magickPath = "magick";
    private $outputFormat = 'jpg';
    private $validOutputFormats = ['jpg', 'jpeg', 'png', 'gif'];

    /**
     * @param string $pdfFile The path or url to the pdffile.
     *
     * @throws WebAtrio\PDFToImage\Exceptions\PDFNotFound
     */
    public function __construct($pdfFile) {
        if (!filter_var($pdfFile, FILTER_VALIDATE_URL) && !file_exists($pdfFile)) {
            throw new PDFNotFound();
        }
        $this->pdfFile = $pdfFile;
    }

    /**
     * @param string $outputFile The path or url to the image file to generate.
     *
     * @throws WebAtrio\PDFToImage\Exceptions\InvalidFormat
     */
    public function convert($outputFile) {
        $ext = pathinfo($outputFile, PATHINFO_EXTENSION);
        if (in_array($ext, $this->validOutputFormats)) {
            exec("magick " . $this->pdfFile . " " . $outputFile . " 2>&1", $output);
            var_dump("magick " . $this->pdfFile . " " . $outputFile . " 2>&1");
            var_dump($output);
        } else {
            throw new InvalidFormat();
        }
    }

    function getPdfFile() {
        return $this->pdfFile;
    }

    function getOutputFormat() {
        return $this->outputFormat;
    }

    function getValidOutputFormats() {
        return $this->validOutputFormats;
    }

    function setPdfFile($pdfFile) {
        $this->pdfFile = $pdfFile;
    }

    function setOutputFormat($outputFormat) {
        $this->outputFormat = $outputFormat;
    }

    function setValidOutputFormats($validOutputFormats) {
        $this->validOutputFormats = $validOutputFormats;
    }

    function getMagickPath() {
        return $this->magickPath;
    }

    function setMagickPath($magickPath) {
        $this->magickPath = $magickPath;
    }

}
