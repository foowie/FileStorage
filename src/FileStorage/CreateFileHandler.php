<?php

namespace FileStorage;

/**
 * @author David Fiedor <davefu@seznam.cz>
 */
class CreateFileHandler extends \Nette\Object implements \Messaging\IHandler {

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
     * @param \FileStorage\CreateFileCommand $message
     */
    public function handle($message) {
        $command = new PrepareFileEntityCommand($message->getFileName(), $message->getMimeType(), $message->getSize(), $message->getGenerateComplexFileName());
        $fileEntityId = $this->bus->send($command);

        $fileEntity = $this->repository->find($fileEntityId);

        rename($message->getFileName(), $this->filePath->getPath($fileEntity));

        return $fileEntity->id;
    }

}
