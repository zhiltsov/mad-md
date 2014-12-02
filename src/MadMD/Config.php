<?php
namespace MadMD;

class Config
{

	const DIR_TEMPLATES = '/templates';
	const DIR_MD_FILES = '/md';

	private $dirTemplates;
	private $dirMdFiles;
	private $dirWebRoot;

	public function getDirTemplates()
	{
		return $this->dirTemplates;
	}

	public function setDirTemplates($dir)
	{
		$this->dirTemplates = $dir;

		return $this;
	}

	public function getDirMdFiles()
	{
		return $this->dirMdFiles;
	}

	public function setDirMdFiles($dir)
	{
		$this->dirMdFiles = $dir;

		return $this;
	}

	public function getDirWebRoot()
	{
		return $this->dirWebRoot;
	}

	public function setDirWebRoot($dir)
	{
		$this->dirWebRoot = $dir;

		return $this;
	}

	public function __construct() {
		if (!$this->getDirWebRoot()) {
			$this->setDirWebRoot($_SERVER['DOCUMENT_ROOT']);
		}

		if (!$this->getDirTemplates()) {
			$this->setDirTemplates($_SERVER['DOCUMENT_ROOT'] . '/..' . self::DIR_TEMPLATES);
		}

		if (!$this->getDirMdFiles()) {
			$this->setDirMdFiles($_SERVER['DOCUMENT_ROOT'] . '/..' . self::DIR_MD_FILES);
		}

		return $this;
	}
}
