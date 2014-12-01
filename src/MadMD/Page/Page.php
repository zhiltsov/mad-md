<?php
namespace MadMD\Page;

use MadMD\Application;
use Parsedown;

class Page implements PageInterface
{
	protected $url;
	protected $path;
	protected $title;
	protected $description;
	protected $keywords;
	protected $content;
	protected $template;
	protected $childPages = [];

	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}

	/**
	 * @param string $url
	 * @return self
	 */
	public function setUrl($url)
	{
		$this->url = $url;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->path;
	}

	/**
	 * @param string $path
	 * @return self
	 */
	public function setPath($path)
	{
		$this->path = $path;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return self
	 */
	public function setTitle($title)
	{
		$this->title = trim($title);

		return $this;
	}

	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param string $description
	 * @return self
	 */
	public function setDescription($description)
	{
		$this->description = trim($description);

		return $this;
	}

	/**
	 * @return string
	 */
	public function getKeywords()
	{
		return $this->keywords;
	}

	/**
	 * @param string $keywords
	 * @return self
	 */
	public function setKeywords($keywords)
	{
		$this->keywords = trim($keywords);

		return $this;
	}

	/**
	 * @return string
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * @param string $content
	 * @return self
	 */
	public function setContent($content)
	{
		$this->content = $content;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getTemplate()
	{
		return $this->template;
	}

	/**
	 * @param string $template
	 * @return self
	 */
	public function setTemplate($template)
	{
		$this->template = trim($template);

		return $this;
	}

	/**
	 * @return self[]
	 */
	public function getChildPages()
	{
		return $this->childPages;
	}

	/**
	 * @param PageInterface $page
	 * @return self
	 */
	public function addChildPages(PageInterface $page)
	{
		$this->childPages[] = $page;

		return $this;
	}

	public function loadMd()
	{
		$markdown = new Parsedown();
		if ($htmlData = $markdown->text(file_get_contents($this->path))) {
			$htmlComment = [];
			if (preg_match_all('/<!--([^<>]+)[\/\/]?-->/s', $htmlData, $htmlComment)) {
				foreach ($htmlComment[1] as $comment) {
					$meta = [];
					if (preg_match('/@title (.*)$/im', $comment, $meta)) $this->setTitle($meta[1]);
					if (preg_match('/@description (.*)$/im', $comment, $meta)) $this->setDescription($meta[1]);
					if (preg_match('/@keywords (.*)$/im', $comment, $meta)) $this->setKeywords($meta[1]);
					if (preg_match('/@template (.*)$/im', $comment, $meta)) $this->setTemplate($meta[1]);

					$htmlData = str_replace($comment, 'meta', $htmlData);
				}
			}

			$this->setContent($htmlData);
		}

		$this->setUrl(self::path2Url($this->getPath()));

		/**
		 * Возвращает имя файла если не задан title
		 */
		if (!$this->getTitle()) {
			$this->setTitle(($title = array_pop(explode('/', trim($this->getUrl(), '/')))) ? $title : 'home');
		}
	}

	/**
	 * @param string $path
	 * @return string
	 */
	public static function path2Url($path) {
		$dir = Application::getInstance()->getConfig()->getDirMdFiles();
		$url = str_replace([$dir, '.md'], '', $path);
		$url = $url === '/index' ? '/' : $url . '/';

		return $url;
	}

	/**
	 * @param string $path
	 */
	public function __construct($path = null) {
		$this->setPath($path)->loadMd();
	}
}