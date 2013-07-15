<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class PrepareFileEntityCommand extends \Nette\Object implements \Messaging\ICommand {

	protected $originalFileName;
	protected $mime;
	protected $size;
	protected $generateComplexFileName;

	function __construct($originalFileName, $mime, $size, $generateComplexFileName = false) {
		$this->originalFileName = $originalFileName;
		$this->mime = $mime;
		$this->size = $size;
		$this->generateComplexFileName = $generateComplexFileName;
	}

	public function getOriginalFileName() {
		return $this->originalFileName;
	}

	public function getMime() {
		return $this->mime;
	}

	public function getSize() {
		return $this->size;
	}

	public function getGenerateComplexFileName() {
		return $this->generateComplexFileName;
	}

}
