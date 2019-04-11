<?php

class Plugin
{
	function slugify($string)
	{
		$slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
		return strtolower($slug);
	}
}