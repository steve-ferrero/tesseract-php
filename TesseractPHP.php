<?php

namespace WebAtrio\TesseractPHP;

use WebAtrio\TesseractPHP\Exceptions\ParameterNotDefined;
use WebAtrio\TesseractPHP\Exceptions\FileNotFound;
use WebAtrio\PDFToImage\PDFToImage;

class TesseractPHP {

    /**
     * Path to the file.
     *
     * @var string
     */
    private $file;

    /**
     * Path to tesseract executable.
     *
     * @var string
     */
    private $executable = 'tesseract';

    /**
     * Path to tessdata directory.
     *
     * @var string
     */
    private $tessdataDir;

    /**
     * List of languages.
     *
     * @var array
     */
    private $languages = [];

    /**
     * Path to temp folder
     *
     * @var string
     */
    private $temp;

    /**
     * Class constructor.
     *
     * @param string $file
     * @return TesseractOCR
     */
    public function __construct($file) {
        $this->file = $file;
        return $this;
    }

    /**
     * If tessdata directory is defined, return the correspondent command line
     * argument to the tesseract command.
     *
     * @return string
     */
    private function buildTessdataDirParam() {
        return $this->tessdataDir ? " --tessdata-dir $this->tessdataDir" : '';
    }

    /**
     * If one (or more) languages are defined, return the correspondent command
     * line argument to the tesseract command.
     *
     * @return string
     */
    private function buildLanguagesParam() {
        return $this->languages ? ' -l ' . join('+', $this->languages) : '';
    }

    /**
     * Builds the tesseract command.
     *
     * @return string
     */
    public function buildCommand() {
        return $this->executable . ' ' . escapeshellarg($this->file) . ' stdout'
                . $this->buildTessdataDirParam()
                . $this->buildLanguagesParam();
    }

    /**
     * Executes tesseract command and returns the generated output.
     *
     * @return string
     */
    public function run() {
        if (!filter_var($this->file, FILTER_VALIDATE_URL) && !file_exists($this->file)) {
            throw new FileNotFound();
        } else {
            $ext = pathinfo($this->file, PATHINFO_EXTENSION);
            $tempFile = null;
            if ($ext === "pdf") {
                if ($this->temp !== null) {
                    $tempFile = $this->temp . DIRECTORY_SEPARATOR . uniqid() . ".png";
                    $convertor = new PDFToImage($this->file);
                    $convertor->convert($tempFile);
                } else {
                    throw new ParameterNotDefined("The temp folder is not defined");
                }
            }
            if ($tempFile !== null) {
                $this->setFile($tempFile);
            }
            exec($this->buildCommand() . " 2>&1", $output);
            if ($tempFile !== null) {
                unlink($tempFile);
            }
            return $output;
        }
    }

    function getFile() {
        return $this->file;
    }

    function getExecutable() {
        return $this->executable;
    }

    function getTessdataDir() {
        return $this->tessdataDir;
    }

    function getLanguages() {
        return $this->languages;
    }

    function getTemp() {
        return $this->temp;
    }

    function setFile($file) {
        $this->file = $file;
    }

    function setExecutable($executable) {
        $this->executable = $executable;
    }

    function setTessdataDir($tessdataDir) {
        $this->tessdataDir = $tessdataDir;
    }

    function setLanguages($languages) {
        $this->languages = $languages;
    }

    function setTemp($temp) {
        $this->temp = $temp;
    }

}
