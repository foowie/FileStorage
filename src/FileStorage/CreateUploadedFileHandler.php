<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class CreateUploadedFileHandler extends \Nette\Object implements \Messaging\IHandler {

	/** @var \Messaging\IMessageBus */
	protected $bus;

	/** @var \FileStorage\Repository */
	protected $repository;

	/** @var \FileStorage\FilePath */
	protected $filePath;

	function __construct(\Messaging\IMessageBus $bus, \FileStorage\Repository $repository, \FileStorage\FilePath $filePath) {
		$this->bus = $bus;
		$this->repository = $repository;
		$this->filePath = $filePath;
	}

	/**
	 * @param \FileStorage\CreateUploadedFileCommand $message
	 */
	public function handle($message) {
		$command = new PrepareFileEntityCommand($message->getUpload()->getName(), $message->getUpload()->getContentType(), $message->getUpload()->getSize(), false);
		$fileEntityId = $this->bus->send($command);

		$fileEntity = $this->repository->find($fileEntityId);

		$message->getUpload()->move($this->filePath->getPath($fileEntity));

		return $fileEntity->id;
	}

}
