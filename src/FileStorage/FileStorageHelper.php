<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class FileStorageHelper extends \Nette\Object {
	
	/** @var \FileStorage\FilePath */	
	protected $filePath;

	function __construct(\FileStorage\FilePath $filePath) {
		$this->filePath = $filePath;
	}
	
	public function prepareDirectory($fileEntity) {
		$path = $this->filePath->getPath($fileEntity, true);
		if (!file_exists($path)) {
			if(!@mkdir($path, 0777, true)) {
				throw new \Nette\InvalidStateException('Cant create file directory ' . $path);
			}
		}		
	}
	
	public function getFileExtension($fileName, $withDot = false) {
		$dot = strrpos($fileName, '.');
		return ($dot === false) ? '' : substr($fileName, $withDot ? $dot : $dot + 1);
	}	
	
}
