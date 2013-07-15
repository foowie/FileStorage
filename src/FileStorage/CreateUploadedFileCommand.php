<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class CreateUploadedFileCommand extends \Nette\Object implements \Messaging\ICommand {

	/** @var \Nette\Http\FileUpload */
	protected $upload;

	function __construct(\Nette\Http\FileUpload $upload) {
		$this->upload = $upload;
	}

	/**
	 * @return \Nette\Http\FileUpload
	 */
	public function getUpload() {
		return $this->upload;
	}

}
