<?php

namespace App\Services;

class YouTubeTag extends VideoTag
{
	private $file;

	public function __construct($file)
	{
		$this->file = $file;
	}

	public function render()
	{
		return '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$this->file.'"></iframe>';
	}
}
