<?php
/**
 * Created by PhpStorm.
 * User: crowdfavorite
 * Date: 2019-11-22
 * Time: 16:05
 */

namespace App\Services;


class PostService
{
	public function calculateAuthorWords($author)
	{
		$words_count = 0;
		foreach($author->posts as $post) {
			$words_count += str_word_count($post->post_text);
		}
		return $words_count;
	}
}
