<?php

namespace FileStorage;

/**
 * @author David Fiedor <davefu@seznam.cz>
 */
class CreateFileValidator extends \Nette\Object implements \Messaging\IValidator {

    /**
     * @param \FileStorage\CreateFileCommand $message
     * @throws \Messaging\ValidationException
     */
    public function validate($message) {
        if ($message->getFileName() == '') {
            throw new \Messaging\ValidationException("Musíte přiložit soubor");
        }
        if (!file_exists($message->getFileName())) {
            throw new \Messaging\ValidationException("Soubor neexistuje");
        }
    }

}
