<?php

namespace FileStorage;

/**
 * @author Daniel Robenek <daniel.robenek@me.com>
 */
class FileMacros extends \Nette\Latte\Macros\MacroSet {

	public static function install(\Nette\Latte\Compiler $compiler) {
		$me = new static($compiler);
		$me->addMacro('fileUrl', array('FileStorage\FileMacros', 'macroFileUrl'));
		$me->addMacro('filePath', array('FileStorage\FileMacros', 'macroFilePath'));
	}

	public static function macroFileUrl(\Nette\Latte\MacroNode $node, \Nette\Latte\PhpWriter $writer) {
		return $writer->write('echo($presenter->context->getByType(\'FileStorage\FilePath\')->getUrl(%node.word));');
	}

	public static function macroFilePath(\Nette\Latte\MacroNode $node, \Nette\Latte\PhpWriter $writer) {
		return $writer->write('echo($presenter->context->getByType(\'FileStorage\FilePath\')->getPath(%node.word));');
	}

}