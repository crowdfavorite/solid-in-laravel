<?php

namespace App\Jobs;

use App\Page;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PageSavingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $request;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
		$page_data = $this->request->all();

		if ($page_data['publish_date'] == '') {
			$page_data['publish_date'] = now()->toDateString();
		}

		if ($page_data['author_id'] == '') {
			$page_data['author_id'] = auth()->id();
		}

		$page_data['content'] = htmlspecialchars($page_data['content']);
		$page = Page::create($page_data);
		foreach ($this->request->input('photos', []) as $file) {
			$page->addMedia(storage_path('tmp/uploads/'.$file))->toMediaCollection('photos');
		}
    }
}
