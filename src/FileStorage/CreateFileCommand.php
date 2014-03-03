<?php

namespace FileStorage;

/**
 * @author David Fiedor <davefu@seznam.cz>
 */
class CreateFileCommand extends \Nette\Object implements \Messaging\ICommand {

    /** @var string */
    protected $fileName;

    protected $generateComplexFileName;

    function __construct($fileName, $generateComplexFileName = false) {
        $this->fileName = $fileName;
        $this->generateComplexFileName = $generateComplexFileName;
    }

    public function getFileName() {
        return $this->fileName;
    }

    public function getMimeType() {
        return \Nette\Utils\MimeTypeDetector::fromString($this->fileName);
    }

    public function getSize() {
        return filesize($this->fileName);
    }

    public function getGenerateComplexFileName() {
        return $this->generateComplexFileName;
    }

}
