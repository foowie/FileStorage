<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class FilePath extends \Nette\Object {

	private $baseUrl;
	private $basePath;

	function __construct($basePath, $baseUrl, \Nette\Http\IRequest $request) {
		$this->baseUrl = substr($request->getUrl()->getBaseUrl(), 0, -1) . $baseUrl;
		$this->basePath = realpath($basePath);
		if ($this->basePath === false)
			throw new \Nette\InvalidStateException("Invalid base path '$basePath'!");
	}

	public function getRelativePath(\Nette\Database\Table\ActiveRow $file) {
		return $file->directory . '/' . $file->name;
	}

	public function getUrl(\Nette\Database\Table\ActiveRow $file) {
		return $this->baseUrl . $file->directory . '/' . $file->name;
	}

	public function getBaseUrl() {
		return $this->baseUrl;
	}

	public function getPath(\Nette\Database\Table\ActiveRow $file, $pathOnly = false) {
		return $this->basePath . '/' . $file->directory . '/' . ($pathOnly ? '' : $file->name);
	}

	public function getBasePath() {
		return $this->basePath . '/';
	}

}
