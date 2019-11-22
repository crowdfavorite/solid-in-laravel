<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $post_id)
    {
        $post = Post::find($post_id);
        if(!$post){
        	abort(404);
		}

        $validator = Validator::make($request->all(), [
        	'post_text' => 'required',
		]);

        if($validator->fails()) {
        	return back()
				->withInput()
				->withErrors($validator);
		}

        $post->update($request->all());

        foreach ($post->authors as $author) {
        	$words_count = 0;
        	foreach($author->posts as $post) {
        		$words_count += str_word_count($post->post_text);
			}
        	$author->words_count = $words_count;
		}

        $admin = User::where('role', 'admin')->first();

        if($admin) {
        	Mail::send('emails.post_updated', ['post' => $post], function($message) use ($admin){
        		$m->from('noreply@crowdfavorite.com', 'CrowdFavorite Team')
					->to($admin->email, $admin->name)
					->subject('Post Updated');
			});
		}

        return redirect()->route('admin.posts.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update_refactored(PostUpdateRequest $request, Post $post)
    {
//		Instead of this use route model bindig
//		$post = Post::find($post_id);
//        if(!$post){
//        	abort(404);
//		}

//		Use instead a FormRequest class like PostUpdateRequest
//      $validator = Validator::make($request->all(), [
//        	'post_text' => 'required',
//		]);
//
//        if($validator->fails()) {
//        	return back()
//				->withInput()
//				->withErrors($validator);
//		}

        $post->update($request->all());

//		The word count update should be removed and refactored to the PostObserver. Further more, as this contains calculations,
//		which can be complicated (not in this example, but you got point), the calculation itself should be took to a service class
//
//		foreach ($post->authors as $author) {
//        	$words_count = 0;
//        	foreach($author->posts as $post) {
//        		$words_count += str_word_count($post->post_text);
//			}
//        	$author->words_count = $words_count;
//		}

//		To notify an admin, we should use a Notification, which itself should be sent from a Job, as this operation is a
//		queable and its not directly tied to the response. This Job should be dispatched from the Observer.
//        $admin = User::where('role', 'admin')->first();
//        if($admin) {
//        	Mail::send('emails.post_updated', ['post' => $post], function($message) use ($admin){
//        		$m->from('noreply@crowdfavorite.com', 'CrowdFavorite Team')
//					->to($admin->email, $admin->name)
//					->subject('Post Updated');
//			});
//		}
        return redirect()->route('admin.posts.index');
    }

}
