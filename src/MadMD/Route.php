<?php
namespace MadMD;

class Route
{
	protected $mdFile;

	/**
	 * @return string
	 */
	public function getMdFile()
	{
		return $this->mdFile;
	}

	/**
	 * @return string
	 */
	public function getCurrentUrl()
	{
		return $_SERVER['REQUEST_URI'];
	}

	public function __construct()
	{
		$url = $_SERVER['REQUEST_URI'];
		if (substr($url, -1) !== '/') {
			$this->redirect($url . '/');
		}
		$url = rtrim($url, '/');

		$dirMdFiles = Application::getInstance()->getConfig()->getDirMdFiles();
		$path = $dirMdFiles . DIRECTORY_SEPARATOR . ($url ? $url : 'index') . '.md';
		if (strpos($url, '../') === false && is_readable($path)) {
			$this->mdFile = $path;

			return;
		}

		$this->set404();
	}

	/**
	 * @param string $url
	 * @param int $code
	 */
	public function redirect($url, $code = 302)
	{
		http_response_code($code);
		header('Location: ' . $url);
		die();
	}

	/**
	 * 404 Not Found
	 */
	public function set404()
	{
		http_response_code(404);
		die();
	}
} 