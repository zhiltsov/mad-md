<?php
namespace MadMD;

abstract class Singleton
{
	private function __construct()
	{
	}

	private function __clone()
	{
	}

	private function __wakeup()
	{
	}

	public static function getInstance()
	{
		static $instance;

		return $instance ? $instance : $instance = new static();
	}
}
