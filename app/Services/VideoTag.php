<?php

namespace App\Services;

class VideoTag
{
    private $file;

    public function __construct($file)
	{
		$this->file = $file;
	}

	public function render()
	{
		return '<video width="320" height="240" controls src="'.$this->file.'" type="video/mp4"></video>';
	}
}
