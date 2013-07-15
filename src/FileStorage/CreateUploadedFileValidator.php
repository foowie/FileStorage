<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class CreateUploadedFileValidator extends \Nette\Object implements \Messaging\IValidator {

	/**
	 * @param \FileStorage\CreateUploadedFileCommand $message
	 */
	public function validate($message) {
		$upload = $message->getUpload();
		if ($upload == null) {
			throw new \Messaging\ValidationException('Musíte přiložit soubor');
		}

		if (!$upload->isOk()) {
			switch ($upload->getError()) {
				case UPLOAD_ERR_INI_SIZE: throw new \Messaging\ValidationException('Přiložený soubor je příliš veliký!');
				case UPLOAD_ERR_PARTIAL: throw new \Messaging\ValidationException('Soubor nebyl korektně nahrán!');
				case UPLOAD_ERR_NO_FILE: throw new \Messaging\ValidationException('Musíte přiložit soubor!');
				default:
					\Nette\Diagnostics\Debugger::log('Error on file upload: ' . $upload->getError());
					throw new \Messaging\ValidationException('Nastala chyba při ukládání souboru, zkuste to prosím později.');
			}
		}
	}

}
