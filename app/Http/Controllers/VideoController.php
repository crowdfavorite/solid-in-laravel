<?php

namespace App\Http\Controllers;

use App\Services\{VideoRenderer, VideoTag, YouTubeTag, VimeoTag};
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
        $html = "";

        $videos = [
        	new YouTubeTag('IWL3VlwiTxU'),
        	new YouTubeTag('bVQpwxgMQCg'),
//			new VimeoTag(98651011234),
//			new VideoTag('my_video_file.mp4'),
		];



        foreach($videos as $video)
        {
        	$html .= (new VideoRenderer($video))->render();
		}

		return view('home', compact('html'));
    }
}

