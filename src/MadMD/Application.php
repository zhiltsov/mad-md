<?php
/**
 * Mad MD. Markdown CMS.
 *
 * (c) Dmitry Zhiltsov <info@zhiltsov.info>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MadMD;

use MadMD\Page\PageManager;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Application extends Singleton
{
	protected $config;
	protected $route;

	/**
	 * @return Config
	 */
	public function getConfig()
	{
		return $this->config ? $this->config : new Config();
	}

	/**
	 * @return Route
	 */
	public function getRoute()
	{
		return $this->route ? $this->route : new Route();
	}

	/**
	 * @return PageManager
	 */
	public function getPageManager()
	{
		return PageManager::getInstance();
	}

	public function run()
	{
		echo $this;
	}

	/**
	 * @return string
	 */
	public function __toString()
	{
		$pages = $this->getPageManager()->getPages();
		$currentPage = $this->getPageManager()->getCurrentPage();
		$twig = new Twig_Environment(new Twig_Loader_Filesystem($this->getConfig()->getDirTemplates()));

		return $twig->render(
			$currentPage->getTemplate() ? $currentPage->getTemplate() : 'default.html.twig',
			[
				'page' => $currentPage,
				'pages' => $pages
			]
		);
	}
} 