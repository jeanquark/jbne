<?php namespace App\Listeners;

// use App\Events\Unisharp\Laravelfilemanager\Events\ImageIsDeleting;
use Unisharp\Laravelfilemanager\Events\ImageWasDeleted;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\File;

class WasDeletedImageListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ImageIsDeleting  $event
     * @return void
     */
    public function handle(ImageWasDeleted $event)
    {
        $filePath = str_replace(public_path(), "", $event->path());

        // dd($filePath);
        // Delete file in database
        // dd(File::where('path', '=', $filePath)->get());
        File::where('path', $filePath)->delete();
    }
}
