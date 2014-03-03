<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class FileExtension extends \Nette\Config\CompilerExtension {

	public $defaults = array(
		'path' => 'files',
		'table' => 'file',
		'handlerTag' => 'handler',
		'validatorTag' => 'validator',
	);

	public function loadConfiguration() {

		$builder = $this->getContainerBuilder();

		$config = $this->getConfig($this->defaults);

		$builder->addDefinition($this->prefix('repository'))->setClass('FileStorage\Repository')->setArguments(array('@\Nette\Database\Connection', $config['table']));

		$builder->addDefinition($this->prefix('filePath'))->setClass('FileStorage\FilePath', array($this->getContainerBuilder()->parameters['wwwDir'] . '/' . $config['path'], '/'.trim($config['path'], '/').'/'));
		$builder->addDefinition($this->prefix('fileStorageHelper'))->setClass('FileStorage\FileStorageHelper');

		$builder->addDefinition($this->prefix('createFileValidator'))->setClass('FileStorage\CreateFileValidator')->addTag($config['validatorTag']);
		$builder->addDefinition($this->prefix('createUploadedFileValidator'))->setClass('FileStorage\CreateUploadedFileValidator')->addTag($config['validatorTag']);

		$builder->addDefinition($this->prefix('createFileHandler'))->setClass('FileStorage\CreateFileHandler')->addTag($config['handlerTag']);
		$builder->addDefinition($this->prefix('createUploadedFileHandler'))->setClass('FileStorage\CreateUploadedFileHandler')->addTag($config['handlerTag']);
		$builder->addDefinition($this->prefix('prepareFileEntityHandler'))->setClass('FileStorage\PrepareFileEntityHandler')->addTag($config['handlerTag']);
		$builder->addDefinition($this->prefix('deleteFileHandler'))->setClass('FileStorage\DeleteFileHandler')->addTag($config['handlerTag']);


		$builder->getDefinition('nette.latte')->addSetup('FileStorage\FileMacros::install($service->getCompiler(?))', array(null));

	}

}
