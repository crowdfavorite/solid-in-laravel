<?php

namespace App\Http\Controllers;

use App\Page;
use App\Jobs\PageSavingJob;
use App\Http\Requests\StorePageRequest;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
	{
		if ( !auth()->user()->can('page_create')) {
			abort('403');
		}

		$request->validate([
			'title' => 'required',
			'slug' => 'required|unique:pages'
		]);

		$page_data = $request->all();

		if ($page_data['publish_date'] == '') {
			$page_data['publish_date'] = now()->toDateString();
		}

		if ($page_data['author_id'] == '') {
			$page_data['author_id'] = auth()->id();
		}

		$page_data['content'] = htmlspecialchars($page_data['content']);
		$page = Page::create($page_data);
		foreach ($request->input('photos', []) as $file) {
			$page->addMedia(storage_path('tmp/uploads/'.$file))->tomediaCollection('photos');
		}
		return redirect()->route('admin.pages.index');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSolid(StorePageRequest $request)
	{
		PageSavingJob::dispatch($request);

		return redirect()->route('admin.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        //
    }
}
