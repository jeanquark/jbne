<?php namespace App\Listeners;

// use App\Events\Unisharp\Laravelfilemanager\Events\ImageIsUploading;
use Unisharp\Laravelfilemanager\Events\ImageIsUploading;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Support\Facades\Auth;

class IsUploadingImageListener
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
     * @param  ImageIsUploading  $event
     * @return void
     */
    public function handle(ImageIsUploading $event)
    {
        // if (!Auth::guard('web')->check()) {
        if (!Auth::guard('member')->check()) {
            die('<p>You need to be logged in in order to upload files.</p>');
        }
    }
}
