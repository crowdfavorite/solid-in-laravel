<?php

namespace App\Services;


class VideoRenderer
{

	private $video;

	// This violates the Dependency inversion principle because the Higher level modules should not depend on the lower level implementations.
	// In other words the more abstract class should not depend on concrete details of implementations.
	// The VideoRenderer is more abstract, should render any video that we pass and YoutubeTag is a concrete implementation of it.
	// To avoid this, we should use the VideoTag in the dependency injection used in this case:

	// public function __construct(VideoTag $video)

	// Even a better approach, we should create an interface and implement that in the VideoTag class, than we can use that to dependency injection

	// public function __construct(VideoInterface $video)

	public function __construct(YouTubeTag $video)
	{
		$this->video = $video;
	}

	/**
	 * render video
	 */
	public function render()
	{
		return $this->video->render();
	}
}
