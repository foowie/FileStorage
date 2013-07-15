<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class CreateUploadedFileCommand extends \Nette\Object implements \Messaging\ICommand {

	/** @var \Nette\Http\FileUpload */
	protected $upload;
	protected $generateComplexFileName;

	function __construct(\Nette\Http\FileUpload $upload, $generateComplexFileName = false) {
		$this->upload = $upload;
		$this->generateComplexFileName = $generateComplexFileName;
	}

	/**
	 * @return \Nette\Http\FileUpload
	 */
	public function getUpload() {
		return $this->upload;
	}

	public function getGenerateComplexFileName() {
		return $this->generateComplexFileName;
	}

}
