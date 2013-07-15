<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class DeleteFileCommand extends \Nette\Object implements \Messaging\ICommand {

	protected $id;

	/**
	 * @param int|\Nette\Database\Table\ActiveRow $id
	 */
	function __construct($id) {
		$this->id = $id;
	}

	public function getId() {
		return $this->id;
	}

}
