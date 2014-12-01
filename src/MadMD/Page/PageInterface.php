<?php
namespace MadMD\Page;

interface PageInterface
{
	/**
	 * @return string
	 */
	public function getUrl();

	/**
	 * @param string $url
	 * @return self
	 */
	public function setUrl($url);

	/**
	 * @return string
	 */
	public function getPath();

	/**
	 * @param string $path
	 * @return self
	 */
	public function setPath($path);

	/**
	 * @return string
	 */
	public function getTitle();

	/**
	 * @param string $title
	 * @return self
	 */
	public function setTitle($title);

	/**
	 * @return string
	 */
	public function getDescription();

	/**
	 * @param string $description
	 * @return self
	 */
	public function setDescription($description);

	/**
	 * @return string
	 */
	public function getKeywords();

	/**
	 * @param string $keywords
	 * @return self
	 */
	public function setKeywords($keywords);

	/**
	 * @return string
	 */
	public function getContent();

	/**
	 * @param string $content
	 * @return self
	 */
	public function setContent($content);

	/**
	 * @return string
	 */
	public function getTemplate();

	/**
	 * @param string $template
	 * @return self
	 */
	public function setTemplate($template);

	/**
	 * @return self[]
	 */
	public function getChildPages();

	/**
	 * @param PageInterface $page
	 * @return self
	 */
	public function addChildPages(PageInterface $page);

	public function loadMd();

	/**
	 * @param string $path
	 * @return string
	 */
	public static function path2Url($path);
}