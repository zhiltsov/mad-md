<?php
namespace MadMD\Page;

use MadMD\Application;
use MadMD\Singleton;

class PageManager extends Singleton
{
	protected $pages = [];
	protected $currentPage;

	/**
	 * @return Page[]
	 */
	public function getPages()
	{
		if (!$this->pages) $this->scanMd();

		return $this->pages;
	}

	/**
	 * @return Page
	 */
	public function getCurrentPage()
	{
		return $this->currentPage;
	}

	protected function scanMd()
	{
		$dir = Application::getInstance()->getConfig()->getDirMdFiles();
		$this->pages = $this->readDir($dir);
	}

	/**
	 * @param $dir
	 * @return Page[]
	 */
	protected function readDir($dir)
	{
		$arData = [];
		static $pages;

		if ($handle = opendir($dir)) {
			while (false !== ($entry = readdir($handle))) {
				$path = $dir . DIRECTORY_SEPARATOR . $entry;
				if (in_array($entry, ['.', '..']) || !is_file($path)) continue;

				$page = new Page($path);
				$arData[] = $pages[$page->getUrl()] = $page;

				if (Application::getInstance()->getRoute()->getCurrentUrl() === $page->getUrl()) {
					$this->currentPage = $page;
				}
			}

			closedir($handle);
		}

		if ($handle = opendir($dir)) {
			while (false !== ($entry = readdir($handle))) {
				$path = $dir . DIRECTORY_SEPARATOR . $entry;
				if (in_array($entry, ['.', '..']) || !is_dir($path)) continue;

				$path = $dir . DIRECTORY_SEPARATOR . $entry;
				if (is_dir($path) && $childData = $this->readDir($path)) {
					$url = Page::path2Url($path);
					if (isset($pages[$url])) {
						/** @var Page $parent */
						$parent = &$pages[$url];
						foreach ($childData as $childPage) {
							$parent->addChildPages($childPage);
						}
					}
				}
			}

			closedir($handle);
		}

		return $arData;
	}
} 