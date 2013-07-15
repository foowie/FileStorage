<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class DeleteFileHandler extends \Nette\Object implements \Messaging\IHandler {

	/** @var \FileStorage\Repository */
	protected $repository;

	/** @var \FileStorage\FilePath */
	protected $filePath;

	function __construct(\FileStorage\Repository $repository, \FileStorage\FilePath $filePath) {
		$this->repository = $repository;
		$this->filePath = $filePath;
	}

	/**
	 * @param \FileStorage\DeleteFileCommand $message
	 */
	public function handle($message) {
		if($message->getId() === null || $message->getId() === false) {
			return;
		}

		$id = ($message->getId() instanceof \Nette\Database\Table\ActiveRow) ? $message->getId()->id : $message->getId();

		$fileEntity = $this->repository->find($id);

		if($fileEntity !== false) {
			$path = $this->filePath->getPath($fileEntity);
			if (file_exists($path)) {
				if (!@unlink($path)) {
					\Nette\Diagnostics\Debugger::log("Cant delete file $path", \Nette\Diagnostics\Debugger::WARNING);
				}
			}

			$this->repository->delete($id);
		}
	}

}
