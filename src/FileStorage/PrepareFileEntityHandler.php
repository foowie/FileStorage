<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class PrepareFileEntityHandler extends \Nette\Object implements \Messaging\IHandler {

	/** @var \FileStorage\Repository */
	protected $repository;
	
	/** @var \FileStorage\FileStorageHelper */
	protected $helper;
	
	function __construct(\FileStorage\Repository $repository, \FileStorage\FileStorageHelper $helper) {
		$this->repository = $repository;
		$this->helper = $helper;
	}
	
	/**
	 * @param \FileStorage\PrepareFileEntityCommand $message
	 */
	public function handle($message) {
		$fileEntity = $this->repository->create(array(
			'name' => '',
			'directory' => '',
			'originalName' => $message->getOriginalFileName(),
			'mime' => $message->getMime(),
			'size' => $message->getSize(),
		));

		$fileEntity = $this->repository->update($fileEntity->id, array(
			'name' => $fileEntity->id . ($message->getGenerateComplexFileName() ? '-' . \Nette\Utils\Strings::random(32) : '') . $this->helper->getFileExtension($message->getOriginalFileName(), true),
			'directory' => (int) ($fileEntity->id / 10000),
		));

		$this->helper->prepareDirectory($fileEntity);
		
		return $fileEntity->id;
	}

}
