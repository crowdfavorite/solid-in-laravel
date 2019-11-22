<?php

namespace App\Services;


class VimeoTag extends VideoTag
{
	private $file;

	public function __construct($file)
	{
		$this->file = $file;
	}

	public function render()
	{
		if(!is_int($this->file)) {
			throw new \Exception('Bad video ID in '.__CLASS__);
		}
		return '<iframe width="640" height="360" src="https://player.vimeo.com/video/'.$this->file.'" frameborder="0"></iframe>';
	}

	public function renderSolid()
	{
		return '<iframe width="640" height="360" src="https://player.vimeo.com/video/'.$this->file.'" frameborder="0"></iframe>';
	}

}
