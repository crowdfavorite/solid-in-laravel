<?php

namespace App\Http\Controllers;

use App\Services\{VideoTag, YouTubeTag, VimeoTag};
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Child class should not introduce any behaviour - like throwing a new exception - that does not belongs to the parent class
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = [
        	new VideoTag('my_video_file.mp4'),
        	new YouTubeTag('hVfUyO'),
			new VimeoTag('12872530894'),  // will throw an Exception
			new VimeoTag(12872530894),  // will render as expected
		];


        $html = "";

        foreach($videos as $video) {
        	$html .= $video->render();
		}

		return view('home', compact('html'));
    }
}

